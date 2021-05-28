@foreach ($data as $notify)
    @if ($notify->type==2)
        <a href="/userHome/edit/{{$notify->code}}" class="navi-item update-notify" data-id="{{$notify->id}}">
            <div class="navi-link">
                <div class="navi-icon mr-2">
                    <i class="flaticon2-user flaticon2-line- text-success"></i>
                </div>
                <div class="navi-text">
                    @if ($notify->status==1)
                        <div class="font-weight-bold">{{$notify->title}}</div>
                        <div class="font-weight-bold">{{$notify->content}}</div>
                        <div class="font-weight-bold">{{$notify->updated_at}}</div>
                    @else
                        <div class="font-weight-bold">{{$notify->title}}</div>
                        <div class="text-muted">{{$notify->content}}</div>
                        <div class="text-muted">{{$notify->updated_at}}</div>
                    @endif
                </div>
            </div>
        </a>
        <!--end::Item-->
    @else
        <!--begin::Item-->
        <a href="/order/edit/{{$notify->code}}" class="navi-item update-notify" data-id="{{$notify->id}}">
            <div class="navi-link">
                <div class="navi-icon mr-2">
                    <i class="flaticon2-supermarket text-warning"></i>
                </div>
                <div class="navinavinavi-text">
                    @if ($notify->status==1)
                        <div class="font-weight-bold">{{$notify->title}}</div>
                        <div class="font-weight-bold">{{$notify->content}}</div>
                        <div class="font-weight-bold">{{$notify->updated_at}}</div>
                    @else
                        <div class="font-weight-bold">{{$notify->title}}</div>
                        <div class="text-muted">{{$notify->content}}</div>
                        <div class="text-muted">{{$notify->updated_at}}</div>
                    @endif
                </div>
            </div>
        </a>
    <!--end::Item-->
    @endif
@endforeach
