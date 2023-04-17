<div
    x-data="{
        openProjectList: @entangle('openProjectList') ?? false,
        selectedProject: @entangle('selectedProject') ?? false
    }"
    dropdown-project-list-container
    class="relative inline-block text-left">
    <div>
      <button
        x-on:click="toggleProjectListDisplay(true)"
        type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="true" aria-haspopup="true">
        Projects
        <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
      </button>
    </div>

    @if ($openProjectList)
        <div
            role="menu"
            tabindex="-1"
            dropdown-project-list
            x-show="openProjectList"
            aria-orientation="vertical"
            aria-labelledby="menu-button"
            x-on:click.outside="toggleProjectListDisplay(false)"
            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
            <div class="py-1" role="none">
                @forEach ($projects as $project)
                    <a
                        dropdown-project-list-item
                        href="/projects/{{$project['id']}}"
                        class="{{ $openProjectList && $selectedProject == $project['id'] ? 'selected-project block px-4 py-2 text-sm' : 'block px-4 py-2 text-sm'}}"
                        x-on:mouseover="mouseOverProjectItem($event, $el)"
                        x-on:mouseout="mouseOutProjectItem($event, $el)"
                        role="menuitem"
                        tabindex="-1"
                        id="menu-item-{{$project['id']}}">
                        {{ $project['name'] }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
  </div>

  <script type="text/javascript">

    function toggleProjectListDisplay(open) {
        const dropdownProjectListContainer = document.querySelector('[dropdown-project-list-container');
        const wireId = dropdownProjectListContainer.closest('[wire\\:id]').getAttribute('wire:id');

        // invoke livewire method
        Livewire.find(wireId).call('toggleProjectListDisplay', open);

        // apply styles wwhen menu is opened
        setTimeout(() => {
            const dropdownProjectList = document.querySelector('[dropdown-project-list]');
            if (dropdownProjectList) {
                dropdownProjectList.querySelectorAll('[dropdown-project-list-item]').forEach(el => {
                    if (el.classList.contains('selected-project')) {
                        el.classList.add('bg-gray-100');
                        el.classList.add('text-gray-900');
                        el.classList.remove('text-gray-700');
                    }
                });
            }
        }, 1000);
    }

    function mouseOverProjectItem(e, el) {
        if (!el.classList.contains('selected-project')) {
            el.classList.add('bg-gray-100');
            el.classList.add('text-gray-900');
            el.classList.remove('text-gray-700');
        }
    }
    
    function mouseOutProjectItem(e, el) {
        if (!el.classList.contains('selected-project')) {
            el.classList.remove('bg-gray-100');
            el.classList.remove('text-gray-900');
            el.classList.add('text-gray-700');
        }
    }
  </script>
  