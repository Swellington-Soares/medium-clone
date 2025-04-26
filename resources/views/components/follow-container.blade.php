@props(['user'])

<div  x-data="{
    following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
    followerCount: {{ $user->followers()->count() }},
    follow(){
        this.following=!this.following
        axios.post('/follow/{{ $user->username }}')
            .then(({data}) => { this.followerCount = data.followers })
    }
}">
{{ $slot }}
</div>
