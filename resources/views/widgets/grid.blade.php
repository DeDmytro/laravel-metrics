<div class="md:w-3/4 p-2 md:p-0">

    <div class="w-full max-w-3xl">

        <div class="-mx-2 md:flex">

            @foreach(\DeDmytro\Metrics\Services\MetricWidget::all() as $widget)
               @if($widget instanceof  \DeDmytro\Metrics\Types\MultipleValueWidget)
                    <div class="w-full md:w-1/3 px-2">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 pt-5 pb-5 text-center relative z-10">
                                    <h4 class="text-sm uppercase text-gray-500 leading-tight">
                                        {{$widget->title()}}
                                    </h4>
                                    <div class="py-2">
                                        @foreach($widget->values() as $value)
                                            <div class="flex py-1">
                                                <p class="text-xs text-gray-500 leading-tight text-left flex-auto align-middle">
                                                    {{ $value->getLabel() }}
                                                </p>
                                                <h4 class="text-gray-700 font-semibold leading-tight text-center flex-auto align-middle">
                                                    {{ $value->getValue() }}
                                                </h4>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($widget instanceof \DeDmytro\Metrics\Types\ValueWidget)
                    <div class="w-full md:w-1/3 px-2">
                        <div class="rounded-lg shadow-sm mb-4">
                            <div class="rounded-lg bg-white shadow-lg md:shadow-xl relative overflow-hidden">
                                <div class="px-3 pt-8 pb-10 text-center relative z-10">
                                    <h4 class="text-sm uppercase text-gray-500 leading-tight">{{ $widget->title() }}</h4>
                                    <h3 class="text-3xl text-gray-700 font-semibold leading-tight my-3">{{ $widget->value() }}</h3>
{{--                                    <p class="text-xs text-green-500 leading-tight">▲ 57.1%</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>