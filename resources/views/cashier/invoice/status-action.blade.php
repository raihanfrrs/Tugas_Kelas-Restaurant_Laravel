@if ($model->status === 'order')
    <span class="badge rounded-pill bg-primary">Pending</span>
@elseif ($model->status === 'cooking')
    <span class="badge rounded-pill bg-warning">Cooking</span>
@elseif ($model->status === 'serve')
    <span class="badge rounded-pill bg-success">Served</span>
@elseif ($model->status === 'reject')
    <span class="badge rounded-pill bg-danger">Rejected</span>
@endif