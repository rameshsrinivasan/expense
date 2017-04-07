@extends('installer.layout.installer')

@section('license')
done
@stop

@section('environment')
done
@stop

@section('database')
done
@stop

@section('locale')
active
@stop

@section('content')
 <div id="form-content">
<div ng-app="myApp">
        <h1 style="text-align: center;">Locale Information</h1>
        {!! Form::open(['url'=>route('postaccount')]) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- checking if the form submit fails -->
        @if($errors->first('firstname')||$errors->first('lastname')||$errors->first('email')||$errors->first('username')||$errors->first('password')||$errors->first('confirmpassword'))
            <div class="woocommerce-message woocommerce-tracker">
                <div class="fail">
                    @if($errors->first('firstname'))
                        <span id="fail">{!! $errors->first('firstname', ':message') !!}</span><br/>
                    @endif
                    @if($errors->first('lastname'))
                        <span id="fail">{!! $errors->first('lastname', ':message') !!}</span><br/>
                    @endif
                    @if($errors->first('email'))
                        <span id="fail">{!! $errors->first('email', ':message') !!}</span><br/>
                    @endif
                    @if($errors->first('username'))
                        <span id="fail">{!! $errors->first('username', ':message') !!}</span><br/>
                    @endif
                    @if($errors->first('password'))
                        <span id="fail">{!! $errors->first('password', ':message') !!}</span><br/>
                    @endif
                    @if($errors->first('confirmpassword'))
                        <span id="fail">{!! $errors->first('confirmpassword', ':message') !!}</span><br/><br/>
                    @endif
                </div>
            </div>        
        @endif

        <!-- checking if the system fails -->
        @if(Session::has('fails'))
            <div class="woocommerce-message woocommerce-tracker">
                <div class="fail">
                    <span id="fail">{{Session::get('fails')}} </span><br/><br/>
                </div>
            </div>
        @endif

    <div ng-controller="MainController">
            <table>                
                <p>Welcome to the five-minute {{Config::get('app.name')}} installation process! Just fill in the information below.</p>
                <h1 style="border-top:1px solid #dedede; border-bottom:1px solid #dedede; padding: 10px 0px 10px 0px;">Admin Information</h1>
                <p>Please provide the following information. Don’t worry, you can always change these settings later.</p>
                <div>
                    <tr>
                        <td>
                            <label for="box1">{!! Lang::get('lang.firstname') !!}<span style="color
                                : red;font-size:12px;">*</span></label>
                        </td>
                        <td>
                            {!! Form::text('firstname',null,['style' =>'margin-left:250px']) !!}
                        </td>
                        <td>
                            <button type="button" data-toggle="popover" data-placement="right" data-arrowcolor="#eeeeee" data-bordercolor="#bbbbbb" data-title-backcolor="#cccccc" data-title-bordercolor="#bbbbbb" data-title-textcolor="#444444" data-content-backcolor="#eeeeee" data-content-textcolor="#888888" title="@{{Nametitle}}" data-content="@{{Namecontent}}" style="padding: 0px;border: 0px; border-radius: 5px;"><i class="fa fa-question-circle" style="padding: 0px;"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="box2">Last Name<span style="color
                                : red;font-size:12px;">*</span></label>
                        </td>
                        <td>
                            {!! Form::text('lastname',null,['style' =>'margin-left:250px']) !!}
                        </td>
                        <td>
                            <button type="button" data-toggle="popover" data-placement="right" data-arrowcolor="#eeeeee" data-bordercolor="#bbbbbb" data-title-backcolor="#cccccc" data-title-bordercolor="#bbbbbb" data-title-textcolor="#444444" data-content-backcolor="#eeeeee" data-content-textcolor="#888888" title="@{{Lasttitle}}" data-content="@{{Lastcontent}}" style="padding: 0px;border: 0px; border-radius: 5px;"><i class="fa fa-question-circle" style="padding: 0px;"></i>
                            </button>
                        </td>
                    </tr>
                </div>
            </table>
            <table>
                <h1>Admin Login Information</h1>
                <div>
                    <!-- <tr>
                        <td>
                            <label for="box4">User Name <span style="color
                                    : red;font-size:12px;">*</span>
                            </label>
                        </td>
                        <td>
                            {!! Form::text('username',null,['style' =>'margin-left:195px']) !!}
                        </td>
                        <td>
                            <button type="button" data-toggle="popover" data-placement="right" data-arrowcolor="#eeeeee" data-bordercolor="#bbbbbb" data-title-backcolor="#cccccc" data-title-bordercolor="#bbbbbb" data-title-textcolor="#444444" data-content-backcolor="#eeeeee" data-content-textcolor="#888888" title="@{{UserNametitle}}" data-content="@{{UserNamecontent}}" style="padding: 0px;border: 0px; border-radius: 5px;"><i class="fa fa-question-circle" style="padding: 0px;"></i>
                            </button>
                        </td>
                    </tr> -->
                    <tr>
                        <td>
                            <label for="box4">Email<span style="color
                                : red;font-size:12px;">*</span></label>
                        </td>
                        <td>
                            {!! Form::text('email',null,['style' =>'margin-left:195px']) !!}
                        </td>
                        <td>
                            <button type="button" data-toggle="popover" data-placement="right" data-arrowcolor="#eeeeee" data-bordercolor="#bbbbbb" data-title-backcolor="#cccccc" data-title-bordercolor="#bbbbbb" data-title-textcolor="#444444" data-content-backcolor="#eeeeee" data-content-textcolor="#888888" title="@{{Emailtitle}}" data-content="@{{Emailcontent}}" style="padding: 0px;border: 0px; border-radius: 5px;"><i class="fa fa-question-circle" style="padding: 0px;"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="box4">Password <span style="color
                                    : red;font-size:12px;">*</span>
                            </label>
                        </td>
                        <td>
                            <input type="password" name="password" style="margin-left: 195px" >
                        </td>
                        <td>
                            <button type="button" data-toggle="popover" data-placement="right" data-arrowcolor="#eeeeee" data-bordercolor="#bbbbbb" data-title-backcolor="#cccccc" data-title-bordercolor="#bbbbbb" data-title-textcolor="#444444" data-content-backcolor="#eeeeee" data-content-textcolor="#888888" title="@{{Passtitle}}" data-content="@{{Passcontent}}" style="padding: 0px;border: 0px; border-radius: 5px;"><i class="fa fa-question-circle" style="padding: 0px;"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="box5">Confirm Password<span style="color
                                    : red;font-size:12px;">*</span>
                            </label>
                        </td>
                        <td>
                            <input type="password" name="confirmpassword" style="margin-left: 195px" >
                        </td>
                        <td>
                            <button type="button" data-toggle="popover" data-placement="right" data-arrowcolor="#eeeeee" data-bordercolor="#bbbbbb" data-title-backcolor="#cccccc" data-title-bordercolor="#bbbbbb" data-title-textcolor="#444444" data-content-backcolor="#eeeeee" data-content-textcolor="#888888" title="@{{Confirmtitle}}" data-content="@{{Confirmcontent}}" style="padding: 0px;border: 0px; border-radius: 5px;"><i class="fa fa-question-circle" style="padding: 0px;"></i>
                            </button>
                        </td>
                    </tr>
                </div>
            </table>
            <input id="dummy-data" class="input-checkbox" type="checkbox" name="dummy-data">
            <label for="dummy-data" style="color:#3AA7D9">Install dummy data</label>
            <br><br>
            <p class="setup-actions step">
                <input type="submit" id="submitme" class="button-primary button button-large button-next" value="Install">
                <a href="{{url('step4')}}" class="button button-large button-next" style="float: left">Previous</a>
            </p>
        </form>
    </div>
    </p>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>
    <script src="{{asset("lb-faveo/js/angular2.js")}}" type="text/javascript"></script>
    </div>
    </div>
    
@stop