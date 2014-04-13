{% extends authLayout %} {% block meta_title %}Test{% endblock meta_title %} {% block meta_description %}{% endblock
meta_description %} {% block css %} {% endblock %} {% block js %} {% endblock %} {% block main %}
<div class="container">
    <div class="row clearfix transparentBlackBg well ui-shadow ui-rounded">
        <div class="col-md-12 column">
            <div class="col-md-2 column">
                <img src="/lib/bundles/{{sBundle}}/img/icon.png" alt="App icon" />
            </div>
            <div class="col-md-8 page-header">
                <h1>
                    {{tr['welcome']}}! <small>{{tr['login_to_your_account']}}</small>
                </h1>
            </div>
            <form class="form-horizontal col-md-12" role="form" method="POST"
                action="/auth/home/index/{% if redirect|Exists %}redirect/{{redirect}}/{% endif %}">
                <div class="alert alert-info">
                    <p><span class="glyphicon glyphicon-info-sign"></span> {{tr['login_helper']}}</p>
                </div>
                <div class="form-group">
                    <label for="emailInput" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" placeholder="Type your email john.doe@domain.com"
                            class="form-control input-lg" id="emailInput" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" placeholder="type your password" class="form-control input-lg"
                            id="inputPassword" name="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label><input type="checkbox" class="" /> Remember me</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="submit" id="submit" class="btn btn-lg btn-primary"
                            data-loading-text="Loading...">Sign in</button>
                        <button type="button" class="btn btn-default btn-lg"
                            data-loading-text="Loading...">Forgot Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}
