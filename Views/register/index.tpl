{% extends authLayout %} 
{% block meta_title %}Auth - Connection à votre compte{% endblock meta_title %} 
{% block meta_description %}Connection à votre compte utilisateur.{% endblock meta_description %} 
{% block css %} {% endblock %} 
{% block js %} {% endblock %} 
{% block main %}
<div class="container">
    <div class="row clearfix transparentBlackBg well ui-shadow ui-rounded">
        <div class="col-md-12 column">
            <div class="col-md-2 column">
                <img src="/lib/bundles/{{sBundle}}/img/icon.png" alt="App icon" />
            </div>
            <div class="col-md-8 page-header">
                <h1>
                    {{tr['welcome']}}! <small>{{tr['register_account']}}</small>
                </h1>
            </div>
            <form class="form-horizontal col-md-12" role="form" method="POST"
                action="/auth/register">
                {% if ! bRegistrationStatus|Exists %}
                <div class="alert alert-info">
                    <p><span class="glyphicon glyphicon-info-sign"></span> {{tr['register_helper']}}</p>
                </div>
                {% else %}
                    {% if bRegistrationStatus %}
                    <div class="alert alert-success">
                        <p><span class="glyphicon glyphicon-success-sign"></span> {{tr['registration_succes']}}</p>
                    </div>
                    {% else %}
                    <div class="alert alert-danger">
                        <p>{{tr['registration_error']}}</p>
                        {% for sError in aRegisterErrors %}
                            <p><span class="glyphicon glyphicon-warning-sign"></span> {{tr[sError]|Safe}}</p>
                        {% endfor %}
                    </div>
                    {% endif %}
                {% endif %}
                <div class="form-group">
                    <label for="emailInput" class="col-sm-2 control-label">{{tr['your_firstname']}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{tr['your_firstname_helper']}}"
                            required="required" data-validation-required-message="{{tr['your_firstname_error']}}"
                            class="form-control input-lg" id="emailInput" name="firstname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="emailInput" class="col-sm-2 control-label">{{tr['your_lastname']}}</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="{{tr['your_lastname_helper']}}"
                            required="required" data-validation-required-message="{{tr['your_lastname_error']}}"
                            class="form-control input-lg" id="emailInput" name="lastname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="emailInput" class="col-sm-2 control-label">{{tr['your_email']}}</label>
                    <div class="col-sm-10">
                        <input type="email" placeholder="{{tr['your_email_helper']}}"
                            required="required" data-validation-required-message="{{tr['your_email_error']}}"
                            class="form-control input-lg" id="emailInput" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">{{tr['your_password']}}</label>
                    <div class="col-sm-10">
                        <input type="password" placeholder="{{tr['your_password_helper']}}" class="form-control input-lg"
                            required="required" data-validation-required-message="{{tr['your_password_error']}}"
                            id="inputPassword" name="password1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">{{tr['your_password_confirm']}}</label>
                    <div class="col-sm-10">
                        <input type="password" placeholder="{{tr['your_password_confirm_helper']}}" class="form-control input-lg"
                            required="required" data-validation-required-message="{{tr['your_password_confirm_error']}}"
                            id="inputPassword" name="password2">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10 text-right">
                        <button type="submit" id="submit" class="btn btn-lg btn-primary"
                            data-loading-text="Loading...">{{tr['register']}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{% endblock %}
