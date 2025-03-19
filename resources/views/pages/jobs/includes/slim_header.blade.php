<div class="jobs-page-header slim-job-header">
    <div class="container jobs-header-container">
        <div class="jobs-page-header-inner">
            <div class="jobs-page-header-image">
                <img src="{{ asset('storage/' .  $company->logo ) }}" alt="{{ $company->name }}">
            </div>
            <div class="jobs-page-header-content">
                <div class="jobs-page-header-content-inner">
                    <div class="jobs-page-header-content-title">
                        <h1>{{ $job->title }}</h1>
                        <h3><a href="{{ route('companies.show', $company->id) }}">{{ $company->name }}</a></h3>
                    </div>
                    <div class="jobs-page-header-content-actions">
                        <?php if(Auth::user()){ ?>
                            <?php if(Auth::user()->id == $job->user_id){ ?>                                
                                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-primary">Edit Job</a>
                            <?php } ?>
                        <?php } else {?>
                            <a href="{{ route('login') }}" class="btn btn-primary">Login to Apply</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>