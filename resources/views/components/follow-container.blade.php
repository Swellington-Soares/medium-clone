@auth
    @props(['user'])

    <div x-data="{
        following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
        followerCount: {{ $user->followers()->count() }},
        follow(){
            axios.post('/follow/{{ $user->username }}')
                .then(({data}) => {
                 this.following=!this.following;
                 this.followerCount = data.followers
             })
        }
    }">
        {{ $slot }}
    </div>

@endauth
