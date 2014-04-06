<!DOCTYPE html>
<html lang="{{lang|Substr: "0,2"|lower}}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <title>{% block meta_title %}{{tr['login']}}{% endblock %}</title>
        
        <meta name="description" content="{% block meta_description %}{% endblock %}" />
        <meta name="keywords" content="{% block meta_keyword %}{% endblock %}" />
        <meta name="application-name" content="{% block meta_app %}sociableCore{% endblock %}" />
        <meta name="author" content="{% block meta_author %}Nicolas BONNICI{% endblock %}" />        

        <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
        <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
        <!--script src="js/less-1.3.3.min.js"></script-->
        <!--append ‘#!watch’ to the browser URL, then refresh the page. -->

        <link href="/lib/plugins/bootstrap3/css/bootstrap.min.css" rel="stylesheet">
        <link href="/lib/plugins/bootstrap3/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="/lib/sociableUx/css/core.classes.css" rel="stylesheet">
        <link href="/lib/plugins/pnotify/css/jquery.pnotify.default.css" rel="stylesheet">
        <link href="/lib/plugins/pnotify/css/jquery.pnotify.default.icons.css" rel="stylesheet">
        <link href="/lib/sociableUx/css/core.ui.css" rel="stylesheet">               

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/lib/img/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/lib/img/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/lib/img/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/lib/img/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="/lib/img/favicon.png">        
        
        {% block css %}{% endblock %}            
        
    </head>
    <body class="GPUrender">        

        {% block main %}{% endblock %}  

        <script type="text/javascript" src="/lib/js/jquery-1.11.min.js"></script>
		<script	type="text/javascript" src="/lib/plugins/layout/js/jquery.layout.min.js"></script>
		<script type="text/javascript" src="/lib/plugins/bootstrap3/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/lib/plugins/pnotify/js/jquery.pnotify.js"></script>
        <script type="text/javascript" src="/lib/sociableUx/js/ux.core.js"></script>
        <script type="text/javascript" src="/lib/sociableUx/js/core.js"></script>
		{% block js %}{% endblock %}
    </body>
</html>