<li     data-route="{{ is_string($value) ? explode('.',$value)[0]  : '' }}"
        class="{{ (is_string($value) and explode('.',request()->route()->getName())[0]==explode('.',$value)[0]) ? 'active-item' : '' }}"
        {{ is_array($value)  ? 'data-is_parent=1' : ''  }}
>
    <!-- menu item -->
    @if($level==1)
        <a href="javascript:void(0)">
            <div class="item-content">
                <!-- get icon from key name split by pipe sign -->
                <div class="item-media">
                    @if(count(explode('|',$key))>1)
                    <i class="{{ explode('|',$key)[1] }}"></i>
                    @endif
                </div>
                <div class="item-inner">
                    <span class="title"> {{ explode('|',$key)[0] }}</span><i class="icon-arrow"></i>
                </div>
            </div>
        </a>
    @else
        @if(is_array($value))
            <a href="javascript:;">
                <span>{{ $key }}</span> <i class="icon-arrow"></i>
            </a>
        @else
            <a href="{{ $value=='' ? '#' : route($value) }}" >
                <span>{{ $key }}</span>
            </a>
        @endif
    @endif

    @if (is_array($value))
        <!-- begin sub menu -->
        <ul class="sub-menu">
        <!--{{ $level=$level+1 }} -->
            @foreach ($value as $key=>$value)
                @include('layouts.partials.navigation', [$key,$value,$level])
            @endforeach
        </ul>
        <!-- end sub menu -->
    @endif
</li>
