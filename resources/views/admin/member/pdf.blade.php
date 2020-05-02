<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Member Information</title>
<style type="text/css">

@page {
	margin: 1cm;
}

body {
  font-family: sans-serif;
	margin: 0.5cm 0;
	text-align: justify;
}

#header1,
#footer {
  position: fixed;
  left: 0;
	right: 0;
	color: #aaa;
	font-size: 0.9em;
}

#header {
  top: 0;
	border-bottom: 0.1pt solid #aaa;
}

#footer {
  bottom: 0;
  border-top: 0.1pt solid #aaa;
}

#header table,
#footer table {
	width: 100%;
	border-collapse: collapse;
	border: none;
}

#header td,
#footer td {
  padding: 0;
	width: 50%;
}

.page-number {
  text-align: center;
}

.page-number:before {
  content: "Page " counter(page);
}

hr {
  page-break-after: always;
  border: 0;
}
.label {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.label-success {
    background-color: #5cb85c;
}
.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}
.label-primary {
    background-color: #337ab7;
}
.label-default {
    background-color: #777;
}
</style>
  
</head>

<body>

<div id="header">
  <table>
    <tr>
      <td><img src="{{asset('public/logo.jpg')}}" width="110px" height="70px"></td>
      <td style="text-align: center; color:#000"><h3>{{env('APP_NAME')}}</h3></td>
      <td style="text-align: right; font-size:11px">{{$member->member_request_id}}</td>
    </tr>
  </table>
</div>

<div align="center"><h3> Member/h3></div>
<div align="center" style="width:100%">
<table  align="center" cellpadding="5px" cellspacing="10px">
  <tr>
      <td width="30%">Status :</td>
      <td width="50%">
      @if($member->status == 0)
      <span class="label label-default">Pending</span>
      @elseif($member->status == 1)
      <span class="label label-primary">Approved</span>
      @endif
      </td>
    </tr>
    <tr>
      <td width="30%">Request Id :</td>
      <td>{{$member->member_request_id}}</td>
    </tr>
    <tr>
      <td>Name :</td>
      <td>{{$member->name}}</td>
    </tr>
    <tr>
      <td>Age :</td>
      <td>{{$member->age}}</td>
    </tr>
    <tr>
      <td>Sex :</td>
      <td>{{$member->sex}}</td>
    </tr>
    <tr>
      <td>Address :</td>
      <td>{{$member->address}}</td>
    </tr>
    <tr>
      <td>Village Town :</td>
      <td>{{$member->village_town}}</td>
    </tr>
    <tr>
      <td>District :</td>
      <td>{{$member->district}}</td>
    </tr>
    <tr>
      <td>Pincode :</td>
      <td>{{$member->pincode}}</td>
    </tr>
    <tr>
      <td>Mobile :</td>
      <td>{{$member->mobile}}</td>
    </tr>

    <tr>
      <td>Email :</td>
      <td>{{$member->email ? $member->email : "Not Available"}}</td>
    </tr>
    <tr>
      <td>Voluntary Service :</td>
      <td>@if($member->voluntary_service == 1)
          Yes
          @else
          No
          @endif      
      </td>
    </tr>
    @if($member->member_package_id != null)
    <tr>
      <td>Member package :</td>
      <td>{{$member->memberPackage->name}}</td>
    </tr>
    @endif
    <tr>
      <td>Relief :</td>
      <td>@if($member->relief == 1)
          Yes
          @else
          No
          @endif      
      </td>
    </tr>

    <tr>
      <td>Medical Assistance :</td>
      <td>@if($member->medical_assistance == 1)
          Yes
          @else
          No
          @endif      
      </td>
    </tr>

    <tr>
      <td>Other :</td>
      <td>@if($member->other == 1)
          Yes
          @else
          No
          @endif      
      </td>
    </tr>

    @if($member->other == 1)
    <tr>
      <td>Message :</td>
      <td>{{$member->message ? $member->message : "Not Available"}}</td>
    </tr>
    @endif
  </table>
  </div>
</body></html>
