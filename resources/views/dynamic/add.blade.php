@extends('layouts.comm')
@section('single')
    <link href="{{asset('static/js/control/css/zyUpload.css')}}" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="{{asset('static/css/marker.css')}}"/>
    <script type="text/javascript" src="{{asset('static/js/core/zyFile.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/control/js/zyUpload.js')}}"></script>
    <script type="text/javascript" src="{{asset('static/js/core/jq22.js')}}"></script>
@endsection
@section('content')
    <div class="container">
        <div class="bs-callout bs-callout-danger" id="callout-tables-striped-ie8">
            <h4>开始积累你的城市记忆</h4>
            <p>千里之行始于足下 <code>记录</code> 从现在开始</p>
        </div>
        <form class="form-horizontal" action="{{url("api/Impl_addDynamic")}}" method="post" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="photos" value="" id="photos" />
            <div class="form-group">
                <label class="col-md-1 col-md-offset-3" for="destination">目的地</label>
                <div class="col-md-5">
                    <input type="text" name="destination" class="form-control" id="destination" placeholder="请输入目的地">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-1 col-md-offset-3" for="together">同伴</label>
                <div class="col-md-5">
                    <input type="text" name="together" class="form-control" id="together" placeholder="一起的同伴">
                </div>
                <label class="col-md-2"> <code>用，分割</code></label>
            </div>
            <div class="form-group">
                <label class="col-md-1 col-md-offset-3" for="time">时间</label>
                <div class="col-md-5">
                    <input type="date" name="time" class="form-control" id="time">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-1 col-md-offset-3"  for="tag">心情标签</label>
                <div class="col-md-5">
                   <select>
                       <option>青春</option>
                       <option>回忆</option>
                       <option>文艺</option>
                   </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-1 col-md-offset-3" for="body">想说的话</label>
                <div class="col-md-5">
                    <textarea name="body" class="form-control" rows="5"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-1 col-md-offset-3" for="body">想说的话</label>
                <div class="col-md-5" id="demo">

                </div>
            </div>
            <div class="form-group">
                <label class="col-md-1 col-md-offset-3" for="body">你的足迹</label>
                <input type="hidden" class="form-control" id="lnglat" value=""  name="lnglat">
                <div id="map" style="height:350px;"  style="z-index: 0" class="col-md-8">
                    <div class="search" style="z-index: 999;display: block; top: -20px;right: 0px;float: right;">
                            <input id="tipinput" type="text" value="" placeholder="直接搜索你的足迹">
                    </div>
                </div>
                <script type="text/javascript" src="{{asset('static/js/map/comm.js')}}"></script>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-info btn-lg center-block">提交</button>
            </div>
        </form>
    </div>
@endsection