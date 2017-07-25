<style>

    .ts-pdf{
        height: 8.5in;
        width: 11in;
    }
    .ts-pdf table{
        width: 100%;
        border: 1px solid #000;
        border-collapse: collapse;
        border-spacing: 0;
        margin: 10px 0 20px;
    }
    .ts-pdf td, .ts-pdf th{
        border: 1px solid #000;
        padding: 5px 5px;
    }
    .ts-pdf th{
        font-weight: bold;
    }
    .ts-pdf h1{
        margin: 0 0 5px;
    }
    .ts-pdf h2{
        margin: 0 0 20px;
    }
    .ts-pdf .one-half{
        width: 50%;
        float: left;
        margin: 0;
        padding: 0;
        border: none;
    }
    .ts-pdf .right{
        float: right
    }
    .ts-pdf .left{
        float: left;
    }
    .ts-pdf .clear{
        clear: both;
    }

</style>

<div class="ts-pdf">

    <h1>{{ $company or 'Company Name' }}</h1>
    <h2>Weekly Timesheet</h2>
    
    <div class="one-half employee">
        <strong>Employee Name: </strong>{{ $name or '' }}
    </div>
    <div class="one-half date-range">
        <strong>Starting Date: </strong>{{ $date or '' }}
    </div>
    <div class="clear"></div>

    <table>
        <tbody>
            <tr>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Breaks</th>
                <th>Total Hours</th>
            </tr>
            @foreach(['Moday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                @if(isset($hide_sunday) && $hide_sunday && $day == 'Sunday')
                    @continue
                @endif
                @if(isset($hide_saturday) && $hide_saturday && $day == 'Saturday')
                    @continue
                @endif
                <tr>
                    <td>{{ $day }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: right; font-weight: bold;">Total</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="one-half employee-signature">
        <strong>Employee Signature:</strong>
    </div>
    <div class="one-half approved-signature">
        <strong>Approved By Signature:</strong>
    </div>
    <div class="clear"></div>

</div>
    