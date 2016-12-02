<style>
    /* -- import Bootstrap v3 and Open Sans Font ------------------------------------- */

    @import "//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css";
    @import "//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700";

    /* -- box model ------------------------------------- */

    *,
    *:after,
    *:before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    /* -- main styles ------------------------------------- */

    body {
        font-family: 'Open Sans', sans-serif;

        background: #495a68 url("") no-repeat;

        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-position: center;  /* Internet Explorer 7/8 */
    }

    #enter {
        max-width: 370px;
        margin: 20px auto;
        padding: 30px;
        border-radius: 5px;

        background-color: #e9ecee;

        -webkit-box-shadow: 0px 0px 15px 0px rgba(50, 50, 50, 0.5);
        -moz-box-shadow:    0px 0px 15px 0px rgba(50, 50, 50, 0.5);
        box-shadow:         0px 0px 15px 0px rgba(50, 50, 50, 0.5);
    }

    #enter .logo-image {
        text-align: center;
    }

    #enter img {
        max-width: 100%;
        max-height: 150px;
    }

    #enter h1, #enter p {
        text-align: center;
    }

    #enter h1 {
        font-size: 24px;
        line-height: 24px;
    }

    /* -- form styles ----------------------------------- */

    label {
        display: inline;
        font-size: 1.3em;
        font-weight: 300;
    }

    .input-group {
        position: relative;
        display: table;
        border-collapse: separate;
        margin-bottom: 15px;
        width: 100%;
    }

    .input-field {   
        height: 60px;
        width: 100%;
        border: none;
        border-radius: 5px;
        text-align: center;

        font-size: 1.5em;
        font-weight: 300;
    }

    /* -- input styles ----------------------------------- */

    #enter form input[type="text"],
    #enter form input[type="password"]{
        background-color: #d9dde0;
        color: black;
    }

    #enter form input[type="text"]:hover,
    #enter form input[type="password"]:hover{
        background-color: #ced2d5;
        color: black;
        outline-color: #495a68;
    }

    #enter form input[type="text"]:focus,
    #enter form input[type="password"]:focus{
        background-color: #ecf0f1;
        color: black;
        outline-color: #495a68;
    }

    #enter form input[type="text"]:valid,
    #enter form input[type="password"]:valid{
        background-color: #1abc9c;
        color: black;
        outline-color: #495a68;
    }

    #enter form input[type="text"]:invalid,
    #enter form input[type="password"]:invalid{
        outline-color: #495a68;
    }


    /* -- checkbox styles ----------------------------------- */

    #enter input[type="checkbox"] {
        -webkit-appearance: none;
        width: 30px;
        height: 30px;
        position: relative;
        outline: medium none;
        margin-right: 10px;
        border-radius: 50%;
    }
    #enter input[type="checkbox"]::before {
        width: 28px;
        height: 28px;
        content: "";
        display: block;
        border: 2px solid #495a68;
        border-radius: 50%;
        position: absolute;
    }

    #enter input[type="checkbox"]:checked::before {
        border-color: #495a68;
    }

    #enter input[type="checkbox"]:checked::after {
        width: 14px;
        height: 14px;
        content: "";
        display: block;
        background: #495a68;
        border-radius: 50%;
        position: absolute;
        left: 7px;
        top: 7px;
    }

    #form-login-remember label {
        vertical-align: top;
        line-height: 36px;
        margin-bottom: 0;
    }

    /* -- button styles ----------------------------------- */

    .btn-ok {
        color: #e9ecee;
        background-color: #495a68;
        border-color: #495a68;
    }
    .btn-ok:hover,
    .btn-ok:focus,
    .btn-ok:active,
    .btn-ok.active {
        color: #e9ecee;
        background-color: #3e4d59;
        border-color: #3e4d59;
    }
    .btn-ok:active,
    .btn-ok.active {
        background-image: none;
    }
    .btn-ok.disabled,
    .btn-ok[disabled],
    fieldset[disabled] .btn-ok,
    .btn-ok.disabled:hover,
    .btn-ok[disabled]:hover,
    fieldset[disabled] .btn-ok:hover,
    .btn-ok.disabled:focus,
    .btn-ok[disabled]:focus,
    fieldset[disabled] .btn-ok:focus,
    .btn-ok.disabled:active,
    .btn-ok[disabled]:active,
    fieldset[disabled] .btn-ok:active,
    .btn-ok.disabled.active,
    .btn-ok[disabled].active,
    fieldset[disabled] .btn-ok.active {
        background-color: #428bca;
        border-color: #357ebd;
    }

    /* -- placeholder styles ----------------------------------- */

    #enter form ::-webkit-input-placeholder {
        /* for webkit browsers */
        text-align: center;
        color: #555555;
    }
    #enter form :-moz-placeholder {
        /* for mozilla browsers */
        text-align: center;
        color: #555555;
    }
    #enter form .placeholder {
        text-align: center;
        color: #555555;
    }

</style>
<html>
    <div class="container">
        <div id="enter">
            <div class="logo-image">
                <img src="http://www.officialpsds.com/images/thumbs/Spiderman-Logo-psd59240.png" alt="Logo" title="Logo">
            </div>
            <h1>Admin Page</h1>
            <p>Please be carefull</p>
            <form role="form" method="post" enctype="multipart/form-data" action="{{ url('/login-admin') }}" >
                {{ csrf_field() }}

                @foreach($fieldRegistration as $fieldRegistration)
                <div id="form-login-username" class="input-group">
                    <input id="{{$fieldRegistration->parameter_name}}" class="input-field" name="{{$fieldRegistration->parameter_name}}" placeholder="{{$fieldRegistration->question}}" type="{{$fieldRegistration->type_question}}" size="18" alt="login" required />
                </div>

                @endforeach

                <div id="submit-buton" class="input-group">
                    <input class="btn btn-ok input-field" type="submit" name="Submit" alt="sign in" value="sign in">
                </div>
            </form>
        </div>
    </div>
</html>