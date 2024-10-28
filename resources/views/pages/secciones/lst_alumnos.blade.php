<table class="table table-striped">
    <thead>
        <tr>
            <th width="100%" style="border-bottom: 1px solid #000000; color: #000000;text-align: center;font-weight: bold;font-size: 12px;">Tipo Documento</th>
            <th width="100%" style="border-bottom: 1px solid #000000; color: #000000;text-align: center;font-weight: bold;font-size: 12px;">Documento</th>
            <th width="100%" style="border-bottom: 1px solid #000000; color: #000000;text-align: center;font-weight: bold;font-size: 12px;">Alumno</th>
			
			<th width="100%" style="border-bottom: 1px solid #000000; color: #000000;text-align: center;font-weight: bold;font-size: 12px;">Correo</th>
            <th width="100%" style="border-bottom: 1px solid #000000; color: #000000;text-align: center;font-weight: bold;font-size: 12px;">Telefono</th>
        </tr>        
    </thead>
    <tbody>
        @foreach($data->notas as $item)
        <tr>            
            <td style="border-bottom: 1px solid #000000; color: #000000;"> {{$item->persona->tipo_doc != null ? $item->persona->tipo_doc->nombre : ''}} </td>
            <td style="border-bottom: 1px solid #000000; color: #000000;"> {{$item->persona->documento}} </td>
            <td style="border-bottom: 1px solid #000000; color: #000000;"> {{$item->persona->apellidos}} {{$item->persona->nombres}} </td>
			
			<td style="border-bottom: 1px solid #000000; color: #000000;"> {{$item->persona->correo}} </td>
			<td style="border-bottom: 1px solid #000000; color: #000000;"> {{$item->persona->telefono}} </td>
        </tr>
        @endforeach
    </tbody>
</table>