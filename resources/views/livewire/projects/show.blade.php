<div>
    <livewire:projects.dropdown :projects="$projects" :selected-project="null"/>
    <br/><br/>
    <h4>Project : {{ isset($project['name']) ? $project['name'] : '' }}</h4> 
    <br/>
    <h4>Task List :</h4>
    <br/>
    <livewire:tasks.draggable-list :tasks="$tasks"/>
</div>