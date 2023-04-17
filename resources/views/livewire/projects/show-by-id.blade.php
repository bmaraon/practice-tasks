<div>
    <livewire:projects.dropdown :projects="$projects" :selected-project="$selectedProject"/>
    <br/><br/>
    <h4>Project : {{$project['name']}}</h4> 
    <br/>
    <h4>Task List :</h4>
    <br/>
    <livewire:tasks.draggable-list :tasks="$tasks"/>
</div>