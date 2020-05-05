<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title>Donation</title>
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
      <td style="text-align: right; font-size:11px">{{$donation->donation_request_id}}</td>
    </tr>
  </table>
</div>

<div align="center"><h3> Cash Donation </h3></div>
<div align="center" style="width:100%">
<table  align="center" cellpadding="5px" cellspacing="10px">
  
    <tr>
      <td width="30%">Request Id :</td>
      <td>{{$donation->donation_request_id}}</td>
    </tr>
    
    <tr>
      <td>Name :</td>
      <td>{{$donation->name}}</td>
    </tr>
    <tr>
      <td>Age :</td>
      <td>{{$donation->age}}</td>
    </tr>
    <tr>
      <td>Sex :</td>
      <td>{{$donation->sex}}</td>
    </tr>
    <tr>
      <td>Address :</td>
      <td>{{$donation->address}}</td>
    </tr>
    <tr>
      <td>Village Town :</td>
      <td>{{$donation->village_town}}</td>
    </tr>
    <tr>
      <td>District :</td>
      <td>{{$donation->district}}</td>
    </tr>
    <tr>
      <td>Pincode :</td>
      <td>{{$donation->pincode}}</td>
    </tr>
    <tr>
      <td>Mobile :</td>
      <td>{{$donation->mobile}}</td>
    </tr>

    <tr>
      <td>Email :</td>
      <td>{{$donation->email ? $donation->email : "Not Available"}}</td>
    </tr>

    <tr>
      <td>Amount of Donation :</td>
      <td>{{$donation->donation_amount ? $donation->donation_amount : "Not Available"}}</td>
    </tr>


    <tr>
      <td>Pupose of Donation :</td>
      <td>{{$donation->donation_purpose ? $donation->donation_purpose : "Not Available"}}</td>
    </tr>

    <tr>
      <td>Pan no :</td>
      <td>{{$donation->pan_no ? $donation->pan_no : "Not Available"}}</td>
    </tr>
    
  </table>
  </div>
</body></html>
