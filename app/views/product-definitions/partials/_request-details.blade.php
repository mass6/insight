<div id="request-details" class="row">
    <div class="col-md-10 col-md-offset-1">


        <blockquote class="blockquote-default" style="padding: 0;margin: 0;border-left: 5px solid #eeeeee;">
            <table class="table" style="margin-bottom: 0;">
                <tbody>
                <tr>
                    <td width="90">Created By:</td>
                    <td width="200">{{ $product->createdBy->name() }}</td>
                    <td width="90">Updated by:</td>
                    <td width="200">{{ $product->updatedBy->name() }}</td>
                    <td width="90">Assigned to:</td>
                    <td>{{ $product->assignedTo->name() }}</td>
                </tr>
                <tr>
                    <td width="90">Created on:</td>
                    <td width="200">{{ $product->created_at }}</td>
                    <td width="90">Updated on:</td>
                    <td width="200">{{ $product->updated_at }}</td>
                    <td width="90">Status:</td>
                    <td>{{ $product->statusName->name }}</td>

                </tr>
                </tbody>
            </table>
        </blockquote>

    </div>
</div>