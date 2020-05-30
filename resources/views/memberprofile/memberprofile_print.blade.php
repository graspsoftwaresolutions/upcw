
<!DOCTYPE html>
<html>

<head>
  <title>New Member Report</title>
  
  <link rel="stylesheet" type="text/css" href="http://localhost/ums/public/assets/css/materialize.css">
  <style>
    /* Styles go here */
    tr {
        border-bottom: none !important; 
    }

    .page-header, .page-header-space {
      height: 100px;
      z-index:999;
    }
    
    .page-footer, .page-footer-space {
      height: 50px;
    
    }
    
    .page-footer {
      position: fixed;
      bottom: 0;
      width: 100%;
      //border-top: 1px solid black; /* for demo */
      background: #fff; /* for demo */
      color:#000;
    }
    
    .page-header {
      position: fixed;
      top: 0mm;
      width: 100%;
      background: #fff; /* for demo */
      color:#000;
    }
    
    .page {
      page-break-after: always;
    }
    
    @page  {
      margin: 3mm
    }
    
    @media  print {
      @page  {
        //size: landscape; 
        margin: 3mm;
      }
        thead {display: table-header-group;} 
        tfoot {display: table-footer-group;}
       
        button {display: none;}
       
        body {margin: 0;}
      .export-button{
        display:none !important;
      }
      .page-header, .page-header-space {
        height: 70px;
        z-index:999;
      }
      .page-header,.page-table-header-space {
        //background: #fff; /* for demo */
        //color:#000;
      }
      #page-length-option {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #page-length-option td, #page-length-option th {
        //border: 1px solid #ddd !important;
        padding: 4px;
      }
      html {

          //font-family: 'Muli', sans-serif;
          font-weight: normal;
          line-height: 1; 
          color: rgba(0, 0, 0, .87);
          font-size: 12px;
      }
      .nric_no{
        width:10% !important;
      }
      
      .report-address{
        font-weight:bold;
        font-size:14px;
      }

      .page-header-area{
        display: none;
      }
      
    }
    @media  not print {
      table {
          display: table;
          width: 100%;
          border-spacing: 0;
          border-collapse: none;
      }
      .page-table-header-space {
        width: 100%;
       // position: fixed;
        top:101px;
        margin-bottom:20px;
        background: #343d9f; /* for demo */
        z-index:999;
        color:#fff;
        font-size: 14px;
      }
      .tbody-area{
        top:140px;
        //position: absolute;
      }
      .nric_no{
        width:150px !important;
      }
      .page-header-area{
        display: none;
      }
    }
    td, th {
      display: table-cell;
      padding: 7px 5px;
      text-align: left;
      vertical-align: middle;
      //border-radius: 2px;
    }
    .btn, .btn-large, .btn-small, .btn-flat {
      line-height: 36px;
      display: inline-block;
      height: 35px;
      padding: 0 7px;
      vertical-align: middle;
      text-transform: uppercase;
      border: none;
      border-radius: 4px;
      -webkit-tap-highlight-color: transparent;
    }
    .tbody-area{
      color:#000;
    }
    #page-length-option td, #page-length-option th {
      //border: 1px solid #ddd !important;
      padding: 4px;
    }
    .center{
      text-align: center;
    }
    .page{
      padding:25px;
    }
    .align-right{
      text-align:right;
    }
    .clearfix{
      clear:both !important;
    }
    .panel-default {
        border-color: #988989;
    }
    .panel {
        margin-bottom: 20px;
        border: 1px solid #988989;
        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .panel-default>.panel-heading {
        color: #333;
        border-color: #988989;
    }
    .panel-heading {
        padding: 10px 15px;
        border-bottom: 1px solid #988989;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
    }
    .panel-body {
        padding: 15px;
    }
    .input-field.inline input, .input-field.inline .select-dropdown {
        padding-top: 10px;
    }
    input:not([type]), input[type=text]:not(.browser-default), input[type=password]:not(.browser-default), input[type=email]:not(.browser-default), input[type=url]:not(.browser-default), input[type=time]:not(.browser-default), input[type=date]:not(.browser-default), input[type=datetime]:not(.browser-default), input[type=datetime-local]:not(.browser-default), input[type=tel]:not(.browser-default), input[type=number]:not(.browser-default), input[type=search]:not(.browser-default), textarea.materialize-textarea {
        font-size: 1rem;
        -webkit-box-sizing: content-box;
        -moz-box-sizing: content-box;
        box-sizing: content-box;
        width: 100%;
        height: 2rem;
      }
        
  </style>
  <script type="text/javascript">
    
  </script>
</head>

<body>
    <div class="page">
      <h4 class="center">ASSOCIATION OF MAYBANK CLASS ONE OFFICERS</h4>
      <p class="center">REGISTRATION NO:   624 </p>
      <p class="center">ESTABLISHED ON 6th MARCH 1989 UNDER THE TRADE UNION ACT 1959 </p>
      <p class="center">  PART 1 :  MEMBERSHIP APPLICATION FORM</p>
      <table width="100%"> 
        <tr>
          <td width="60%">
            <p>
              Please mail/courier the original completed Form to:- <br>
              The General Secretary    <br>
              Association of Maybank Class One Officers  <br>
              A-03A-06, No 68, Wisma Pantai  <br>
              Jalan Pantai Bahru  <br>
              59200 Kuala Lumpur

            </p>
          </td>
          <td width="40%">
            <div class="panel panel-default">
              <div class="panel-heading">Please select ONE of the options below:-</div>
              <div class="panel-body">
                For Entrance Fee (RM10) & 1st Month- <br>
                Subscription & AMCO Welfare Fund Fees <br>
                HRD will debit directly from the salary.

              </div>
            </div>
          </td>
        </tr>
      </table>
      <p>Dear Sir,</p>

      <p>I wish to become a member of the above TRADE UNION and state that I willing to abide by its rules & Constitution as they are in force from time to time. I declare that the information given below, is to best of my knowledge and belief, true.</p>
      
      <p>I authorise AMCO to deduct the amount for Entrance Fee (RM10), together with payment for monthly subscription fee (RM15
      per month) and also AMCO Welfare Fund (RM1 per month). Payment for the subsequent half-yearly trade union dues of
      RM96-00 shall be debited from my salary on 22nd of April and October of each year. Any further increases in the above 
      rates shall be decided in accordance to Rule 25 of Union's Rules & Constitution. <br>
     
      </p>
      <p style="margin-bottom: 0;">Yours faithfully, </p>
      <div style="width: 50%;float: left;line-height: 1;">Signature : <div class="input-field inline"> <input type="text" value=""  placeholder="" class=""> </div> </div>
      <div style="width: 50%;float: left;text-align: right;">Date : <div class="input-field inline"> <input type="text" value="31-12-2019"  placeholder="" class=""> </div></div>
      <div class="clearfix"></div>

      <div class="panel panel-default">
        <div class="panel-heading">
          NOTE : Rule 3. Membership <br>
          Membership of the Union shall be opened to all Officer 1, Senior Officer and Officer of similar grade who are employed by 
          Malayan Banking Berhad except those who hold as Branch Manager, Assistant Branch Manager (Operations), Department
          Head and any higher post and those employed in Confidential or security posts. They must be above age of 18 and having their
          place of work in Peninsular Malaysia.

        </div>
        <div class="panel-body">
           PART 2 : PARTICULARS OF THE APPLICANT
        </div>
      </div>
      <p>PLEASE TYPE OR WRITE CLEARLY IN BLOCK LETTERS</p>

      <div style="width: 100%;">
        Name : <div class="input-field inline" style="margin:0 !important;"> <input type="text" value="" style="width: 400px;" placeholder="" class=""> </div> 
        P.F No : <div class="input-field inline" style="text-align: right;margin:0 !important;"> <input type="text" value="" style="width: 220px;" placeholder="" class=""> </div>
       
      </div>
      <div class="clearfix"></div> 
      <div style="width: 100%;">
        <div style="width: 20%;float: left;margin-top: 15px;margin-bottom: 15px;">
          Sex : Male / Female
        </div>
        <div style="width: 40%;float: left;margin-bottom: 5px;">
          Status : Single / Married / Others : <div class="input-field inline" style="margin:0 !important;"> <input type="text" value="" style="width: 200px;" placeholder="" class=""> </div>
        </div>
        <div style="width: 40%;float: left;margin-bottom: 5px;">
          Date of Birth : <div class="input-field inline" style="margin:0 !important;"> <input type="text" value="" style="width: 300px;" placeholder="" class=""> </div>
        </div>
         
      </div>
      <div style="width: 100%;">
        New IC No : <div class="input-field inline" style="margin:0 !important;"> <input type="text" value="" style="width: 250px;" placeholder="" class=""> </div> 
        Date Promoted to Scope of AMCO : <div class="input-field inline" style="text-align: right;margin:0 !important;"> <input type="text" value="" style="width: 220px;" placeholder="" class=""> </div>
       
      </div>
      <div style="width: 100%;">
        Full Home Add(COMPULSORY) : <div class="input-field inline" style="margin:0 !important;"> <input type="text" value="" style="width: 540px;" placeholder="" class=""> </div> 
        <br>
        <input type="text" value="" style="width: 540px;margin-left: 185px;" placeholder="" class="">
      </div>


      <table id="page-length-option" class="display table2excel" width="100%">
        <thead>
            
          <tr class="" style="" width="100%">
            <th style="border: 1px solid #988989 !important;">S.NO</th>
            <th style="border: 1px solid #988989 !important;">MEMBER NAME</th>
            <th style="border: 1px solid #988989 !important;">M/NO</th>
            <th style="border: 1px solid #988989 !important;" class="nric_no">NRIC</th>
            <th  style="border: 1px solid #988989 !important;">GENDER</th>
            <th  style="border: 1px solid #988989 !important;">BANK</th>
            <th  style="border: 1px solid #988989 !important;">BANK BRANCH</th>
            <th  style="border: 1px solid #988989 !important;">TYPE</th>
            <th style="border: 1px solid #988989 !important;">DOJ</th>
            <th  style="border: 1px solid #988989 !important;">LEVY</th>
            <th style="border: 1px solid #988989 !important;">TDF</th>
            <th style="border: 1px solid #988989 !important;">AMOUNT</th>
            <th  style="border: 1px solid #988989 !important;">LAST PAID DATE</th>
          </tr>
        </thead>
        <tbody class="" width="100%">
               
          <tr>
            <td colspan="13" style="font-weight:bold;">Total Member's Count : 0</td>
          </tr> 
        </tbody>
      
      </table> 
    </div> 
</body>

<script>
  $(document).ready( function() { 
   // $("html").css('opacity',1);

  
    }); 
  
</script>

</html>