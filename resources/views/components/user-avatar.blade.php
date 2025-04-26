@props(['user', 'size' => 'w-10 h-10'])

<img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"  class="{{ $size }} rounded-full">
