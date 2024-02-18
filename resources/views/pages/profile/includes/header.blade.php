<div class="profile-page-header">
    <div class="container page-header-container">
        <div class="profile-page-header-inner">
            <div class="profile-page-header-image">
                <img src="{{ asset('storage/' .  $user->profile_picture ) }}" alt="{{ $user->name }}">
            </div>
            <div class="profile-page-header-content">
                <div class="profile-page-header-content-inner">
                    <div class="profile-page-header-content-title">
                        <h1>{{ $user->name }}</h1>
                    </div>
                    <div class="profile-page-header-content-subtitle">
                        <?php 
                            if(Auth::check())
                            {
                                // Check to see if user is in profile users followings
                                $isFollowing = App\Models\Followings::where('user_id', $user->id)->where('following_id', Auth::user()->id)->first();

                                if($isFollowing)
                                {
                                    ?>
                                        <h2>{{ $user->username }} &middot; Follows You</h2>
                                    <?php
                                }else{
                                    ?>
                                        <h2>{{ $user->username }}</h2>
                                    <?php
                                }
                            }else{
                        ?>
                            <h2>{{ $user->username }}</h2>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="profile-page-header-content-social-media-icons">
                        <ul>
                            @if($user->portfolio != "")
                                <li><a href="{{ $user->portfolio }}"><i class="fas fa-globe"></i></a></li>
                            @endif
                            @if($user->github != "")
                                <li><a href="{{ $user->github }}"><i class="fab fa-github"></i></a></li>
                            @endif
                            @if($user->facebook != "")
                                <li><a href="{{ $user->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if($user->twitter != "")
                                <li><a href="{{ $user->twitter }}"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if($user->instagram != "")
                                <li><a href="{{ $user->instagram }}"><i class="fab fa-instagram"></i></a></li>
                            @endif
                            @if($user->linkedin != "")
                                <li><a href="{{ $user->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="profile-page-header-content-actions">
                        @if (auth()->user() && auth()->user()->id == $user->id)
                            <a href="{{ route('settings.index') }}" class="btn primary">Edit Settings</a>
                        @else
                            <?php
                            // Show follow button if logged user is not the same as the profile user
                            if(Auth::check())
                            {
                                if(Auth::user()->id != $user->id)
                                {
                                    // Check if logged user is following the profile user
                                    if(Auth::user()->followings->contains('following_id', $user->id))
                                    {
                                        ?>
                                            <form action="{{ route('unfollow') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <button type="submit" class="btn primary-hollow">Unfollow</button>
                                                <a href="{{ route('messages.create_conversation', $user->id) }}" class="btn primary">Message</a>
                                            </form>
                                        <?php
                                    }else{
                                        ?>
                                            <form action="{{ route('follow') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <button type="submit" class="btn primary">Follow</button>
                                                <a href="{{ route('messages.create_conversation', $user->id) }}" class="btn primary">Message</a>
                                            </form>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <a href="{{ route('settings.index') }}" class="btn primary">Edit Settings</a>
                                    <?php
                                }
                            }else{
                                ?>
                                    <a href="{{ route('login') }}" class="btn primary">Login</a>
                                <?php
                            }
                            ?>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>