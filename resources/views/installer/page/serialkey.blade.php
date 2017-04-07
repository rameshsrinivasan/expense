@extends('installer.layout.installer')

@section('serial')
active
@stop

@section('content')
    <div class="wc-setup-content" ng-app="myApp">
        <h1 style="text-align: center;">{{Config::get('app.name')}} Serial Key</h1>
        <p><strong>Please enter your serial key for {{Config::get('app.name')}}</strong></p>
                @if(Session::has('success'))
                    <div class="wc-setup-content">
                        <div class="woocommerce-message woocommerce-tracker">
                            <div class="ok">
                                <span id="fail">{{Session::get('success')}}</span><br/><br/>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- fail message -->
                @if(Session::has('fails'))
                    <div class="wc-setup-content">
                        <div class="woocommerce-message woocommerce-tracker">
                            <div class="fail">
                                <span id="fail">{{Session::get('fails')}}</span><br/><br/>
                            </div>
                        </div>
                    </div>
                @endif
        <form action="#" method="post">
            <input type="hidden" name="domain" value="http://{{ $_SERVER['HTTP_HOST'] }}">
            <input type="hidden" name="url" value="http://{{$_SERVER['HTTP_HOST']}}{{$_SERVER['REQUEST_URI']}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <table ng-controller="AutotabController">
            <div>
                
                <p ng-bind="user"></p>
            </div>
                <tr >
                    <td style="width: 200px;">
                        <label for="box1" id="test">Order Number<span style="color: red;font-size:12px;">*</span>
                        </label>
                        <br/><br/>
                    </td>
                    <td style="">
                        {!! $errors->first('order_no', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="order_no" style="margin-left:180px;width:274px;" value="">
                        <br/><br/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px;">
                        <label for="box1" id="test">Serial key<span style="color: red;font-size:12px;">*</span>
                        </label>
                    </td>
                    <td ng-repeat="productKey in productKeys" style="margin-left: 150px;">
                        {!! $errors->first('serial', '<spam class="help-block">:message</spam>') !!}
                        <input type="text" name="first" id="productKey1" ng-model="productKey.set1" maxlength="4" size="4" required style="padding: 3px; margin-left: 180px; width: 50px;">&nbsp;-
                        <input type="text" name="second" id="productKey2" ng-model="productKey.set2" maxlength="4" size="4" required style="padding: 3px; margin-left: 3px; width: 50px;">&nbsp;-
                        <input type="text" name="third" id="productKey3" ng-model="productKey.set3" maxlength="4" size="4" required style="padding: 3px; margin-left: 3px; width: 50px;">&nbsp;-
                        <input type="text" name="forth" id="productKey4" ng-model="productKey.set4" maxlength="4" size="4" required style="padding: 3px; margin-left: 3px; width: 50px;">
                    </td>
                </tr>
            </table>
            <br>
            <p class="wc-setup-actions step">
                <input type="submit" id="submitme" class="button-primary button button-large button-next" value="Continue">
            </p>
        </form>
    </div>    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset("lb-faveo/js/jquery.autotab.js")}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>
<script src="{{asset("lb-faveo/js/angular.js")}}" type="text/javascript"></script>
@stop