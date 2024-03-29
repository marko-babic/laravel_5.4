@extends('admin.dashboard')

@section('admin_main')
    <div class="admin-main">
        <div class="news">
            <div class="element title-adm"> Navigation bar </div>
            <div class="row" style="padding: 20px;">
                <div class="col-md-4">
                    <ul>
                        @foreach($navigation as $nav)
                            <li data-nav="{{$nav->id}}" data-nav_short="{{$nav->shortcode}}" data-nav_nav="{{$nav->navbar}}"> {{$nav->description}}
                                <span data-action="edit" class="nav-edit glyphicon glyphicon-pencil" title="Edit element"></span>
                                <span data-action="remove" class="nav-edit glyphicon glyphicon-remove" title="Remove element"></span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <form class="form navbar-add-form">
                        <div class="form-group">
                            <label for="nav_description">
                                Description
                                <span class="glyphicon glyphicon-question-sign" title="This is used to orientate when adding posts"></span>
                            </label>
                            <input type="text" class="form-control" id="nav_description" required>
                        </div>
                        <div class="form-group">
                            <label for="nav_shortcode">
                                Shortcode (Url)
                                <span class="glyphicon glyphicon-question-sign" title="This will be displayed in browser navigation bar"></span>
                            </label>
                            <input type="text" class="form-control"  id="nav_shortcode" required>
                        </div>
                        <div class="form-group">
                            <label for="nav_navbar">
                                Navbar item
                                <span class="glyphicon glyphicon-question-sign" title="This will be displayed in navigation bar"></span>
                            </label>
                            <input type="text" class="form-control" id="nav_navbar" title="Navbar" required>
                        </div>
                        <button id="nav_btn" class="btn btn-primary center-block" type="submit">Add new</button>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="element title-adm"> Posts </div>
            @include('admin.slugs.CMS.posts.posts')
        </div>
    </div>
@endsection