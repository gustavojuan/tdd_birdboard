<x-layout>
    <h1>BirdBoard</h1>
    <ul>
        @forelse ($projects as $project)
            <li>
                <a href="">{{ $project->title }}</a>
            </li>
        @empty
            <li>No projects yet.</li>
        @endforelse
    </ul>
</x-layout>
