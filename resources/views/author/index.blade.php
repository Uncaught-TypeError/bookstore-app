<x-guest-layout>
@if ($author == null)
    @foreach ($authors as $author)
    <li class="text-white">Name: {{ $author->name }} <br>
    Famous : {{ $author->famous }} <br>
Followers: {{ $author->followers }} <br>
DOB: {{ $author->dob }}</li>
    @endforeach
@else
    <div class="text-white">Name: {{ $author->name }} <br>
        Famous : {{ $author->famous }} <br>
    Followers: {{ $author->followers }} <br>
    DOB: {{ $author->dob }}</div>
@endif
</x-guest-layout>
