<blockquote class="blockquote-default" style="padding: 0;margin: 0;border-left: 5px solid #eeeeee;">
    <table class="request-details" style="margin-bottom: 0;font-size: 10px;padding: 3px;">
        <tbody class="request-details">
        <tr>
            <td width="80">Created By:</td>
            <td width="180"><strong>{{ $product->createdBy->name() }}</strong></td>
            <td width="80">Updated by:</td>
            <td width="180"><strong>{{ $product->updatedBy->name() }}</strong></td>
            <td width="80">Assigned to:</td>
            <td width="180"><strong>{{ $product->assignedTo->name() }}</strong></td>
        </tr>
        <tr>
            <td width="70">Created on:</td>
            <td width="180">{{ $product->created_at->format('d-m-Y') }}</td>
            <td width="70">Updated on:</td>
            <td width="180">{{ $product->updated_at->format('d-m-Y g:i:s A') }}</td>
            <td width="70">Status:</td>
            <td width="180"><strong><span class="text-info">{{ $product->statusName->name }}</span></strong></td>

        </tr>
        </tbody>
    </table>
</blockquote>