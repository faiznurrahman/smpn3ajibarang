<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Label Eksemplar</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'DejaVu Sans', sans-serif; }

  .page {
    width: 100%;
    padding: 0.6cm 0.7cm;
  }
  .page:not(:last-child) {
    page-break-after: always;
  }

  table.grid {
    border-collapse: collapse;
  }

  table.grid td {
    width: 5.3cm;
    height: 3.3cm;
    padding: 0;
    vertical-align: top;
  }

  .label {
    width: 5cm;
    height: 3cm;
    margin: 0.15cm;
    padding: 0.15cm;
    border: 1px dashed #9ca3af;
    text-align: center;
    overflow: hidden;
  }

  .label-judul {
    font-size: 6.5pt;
    color: #1e293b;
    font-weight: 700;
    line-height: 1.1;
    height: 0.6cm;
    overflow: hidden;
  }

  .label-qr {
    width: 1.55cm;
    height: 1.55cm;
    margin: 0.03cm auto;
  }

  .label-qr img {
    width: 100%;
    height: 100%;
  }

  .label-kode {
    font-family: 'DejaVu Sans Mono', monospace;
    font-size: 7.5pt;
    font-weight: 700;
    color: #0f172a;
    letter-spacing: 0.3px;
  }
</style>
</head>
<body>

@foreach ($labels->chunk(24) as $page)
  <div class="page">
    <table class="grid">
      <tbody>
        @foreach ($page->chunk(3) as $row)
          <tr>
            @foreach ($row as $label)
              <td>
                <div class="label">
                  <div class="label-judul">{{ $label['judul'] }}</div>
                  <div class="label-qr">
                    <img src="data:image/svg+xml;base64,{{ $label['qr'] }}" alt="QR">
                  </div>
                  <div class="label-kode">{{ $label['kode_item'] }}</div>
                </div>
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endforeach

</body>
</html>
