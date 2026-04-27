<style>
    .table-report {
        border-collapse: collapse;
        width: 99%;
        margin: 0px auto;
        margin-bottom: 3px
        /* opcional */
    }

    .table-report,
    .table-report th,
    .table-report td {
        border: 1px solid #03205ecc;
    }
    
    .table-report th,
    .table-report td {
        color: black !important ;
        padding: 3px;
        text-align: left;
        font-size: 12px;
    }
    .table-report tbody tr:nth-child(odd) {
        background-color: #cacaca46;
    }
    
    .table-report tbody tr:nth-child(even) {
        background-color: #ffffff;
    }
    .table-report thead tr th{
        padding: 4px;
        font-size: 16px !important;
        font-weight: bold;
        
    }
</style>

<table {{ $attributes }} >
    @isset($header)
        <thead>
            <tr>

                {{ $header }}
            </tr>
        </thead>
    @endisset
    <tbody>
        {{ $slot }}
    </tbody>
</table>
