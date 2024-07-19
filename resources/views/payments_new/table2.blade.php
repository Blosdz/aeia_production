<table>
    <thead>
      <tr>
        <th>Fecha</th>
        <th>Monto</th>
        <th>Descripción</th>
      </tr>
    </thead>
    <tbody>
      @if ($payments->isEmpty())
        <tr>
          <td colspan="3" class="text-center height-display">
            <i class="fa-regular fa-rectangle-xmark" style="font-size: 50px;"></i>
            <p>Aún no ha hecho un pago</p>
          </td>
        </tr>
      @else
        @foreach ($payments as $payment)
          <tr>
            <td>{{ $payment->date_transaction }}</td>
            <td>{{ $payment->total  }}</td>
            <td>
                <a href="{{ route('payments.show', [$payment->id]) }}" class='btn btn-success'>Ver detalle</a>
                @if ($payment->contract)
                    <a href="{{route('contracts.pdf',[$payment->contract->id])}}" target="_blank" class="btn btn-info"> Ver contrato </a>
                @else
                    <a href="" class="btn btn-disabled disabled"> Ver contrato </a>
                @endif
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>


  