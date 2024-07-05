<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agreement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-top: 20px;
        }
        .header img {
            height: 50px;
            vertical-align: middle;
        }
        .title {
            color: green;
            margin: 0;
        }
        .title p {
            margin: 5px 0;
        }
        .agreement {
            font-weight: bold;
            text-decoration: underline;
            margin: 20px 0;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .conditions, .provisions {
            text-align: left;
            margin: 0 auto;
            width: 80%;
            margin-bottom: 20px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="{{asset('js/custom.js')}}" ></script>


</head>
<body>
    <div class="header">
        <img width="150" hieght="600" src="{{asset('images/aglie_courts_logo.jpg')}}" alt="Logo not found or type unknown">
        <img src="{{asset('images/text_logo.jpg')}}" alt="Logo not found or type unknown">
    </div>

    <h1 class="title">CONSTRUCTION CO.</h1>
    <p class="title">CELEBRATING OUR 50<sup>TH</sup> YEAR 1972-2022</p>
    <p class="title">"QUALITY STILL EXISTS"</p>

    <div class="agreement">AGREEMENT</div>

    <table>
        <tr>
            <th>WORK TO BE PERFORMED</th>
            <th>CUSTOMER</th>
        </tr>
        <tr>
            <td>{{$proposal->work_to_be_performed}}</td>
            <td>{{$proposal->customer}}</td>
        </tr>
    </table>

    <div id class="conditions">
        <p>Agreement made between Agile Courts Construction Company, Inc. hereinafter called the Contractor and test hereinafter called the Customer for the construction of (2) tennis courts and refurbishment of (3) tennis courts of test with respect to the following terms and specifications</p>
        <div id="overseas_conditions">
            <h3>CONDITIONS FOR OVERSEAS INSTALLATIONS</h3>
            <p>The Customer is responsible for round trip airfare to</p>
            <p>The Customer is responsible for any taxes due as a result of this work.</p>

        </div>

        <div id="base" >
            <h3>BASE</h3>
            <p>Area to be approximately:</p>

        </div>

        <div id="">

        </div>
        <h3>FENCE</h3>
        <p>The Contractor will install 10’’ high fence; zinc coated Heavy Duty steel wire chain link with a green or black vinyl coating, () gauge, () mesh, for a total of (550) running feet.</p>

        <h3>LIGHTS</h3>
        <p>The Contractor will furnish and install () BLS () watt LED fixtures, mounted on () () ft. high aluminum/steel light poles.</p>
        <p>The Contractor will install all necessary wiring.</p>
    </div>

    <div class="provisions">
        <p>The Customer agrees to a first payment of $ for deposit.</p>
        <p>The Customer agrees to a second payment of $ for commencement of works.</p>

        <h3>CONDITIONS</h3>
        <p>The Customer agrees to provide a suitable and adequate clean water supply.</p>
    </div>
    
    
    <div>
        
        <span><strong>Accepted by Agile</strong></span>
        <span style="margin-left:150px"><strong>Courts Construction Company</strong></span>
    </div>
    
    <canvas width="400" height="200" id="signature-pad">
        
    </canvas>
    <p>Date: ___________________________</p>
    <p>Bruce Bauer</p>
    <div class="footer">
        <p>PHONE: (305) 667-1228 | EMAIL: INFO@AGILECOURTS.NET</p>

    </div>
</body>
</html>
