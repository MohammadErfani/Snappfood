<div class="mt-3">
    <label class="mb-3 block text-base font-medium text-[#07074D]">open close hour</label>
</div>
<div class="mb-3 mt-2">
    <label for="checkbox" class="mb-3  text-base font-medium text-[#07074D]">same in all week</label>
    <input type="checkbox" id="checkbox" name="checkbox" checked>
</div>
<div id="allWeek" class="w-full px-3 sm:w-1/2 flex">
    <div class="mb-5">
        <label
            for="time"
            class="mb-3 block text-base font-medium text-[#07074D]"
        >
            open hour
        </label>
        <input
            type="time"
            name="time[open]"
            id="time"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"

        />
    </div>
    <div class="mb-5">
        <label
            for="time"
            class="mb-3 block text-base font-medium text-[#07074D]"
        >
            close hour
        </label>
        <input
            type="time"
            name="time[close]"
            id="time"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"

        />
    </div>
</div>
{{--@dd(($restaurant->schedules->all()==[]))--}}
@foreach($weekday as $day=>$value)
<div class="weekDay w-full px-3 sm:w-1/2 flex" style="display: none" >
    <div class="mt-10 mr-5 w-20">
        <span>{{ucfirst($day)}}</span>
    </div>
    <div class="mb-5">
        <label
            for="time"
            class="mb-3 block text-base font-medium text-[#07074D]"
        >
            open hour
        </label>
        <input
            type="time"
            name="open[{{$day}}]"
            value="{{$restaurant->schedules->isNotEmpty() ?$restaurant->schedules[$value]->open_hour:null }}"
            id="time"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"

        />
    </div>
    <div class="mb-5">
        <label
            for="time"
            class="mb-3 block text-base font-medium text-[#07074D]"
        >
            close hour
        </label>
        <input
            type="time"
            name="close[{{$day}}]"
            value="{{$restaurant->schedules->isNotEmpty() ?$restaurant->schedules[$value]->close_hour:null }}"
            id="time"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"

        />
    </div>
</div>

@endforeach
{{--open close hour--}}
<script>
    $("#checkbox").click(function () {
        if ($('#checkbox').is(':checked')) {
            $('.weekDay').css('display', 'none');
            $('#allWeek').css('display', 'flex');

        } else {
            $('.weekDay').css('display', 'flex');
            $('#allWeek').css('display', 'none');

        }
    });
</script>
{{--<div class="weekDay w-full px-3 sm:w-1/2 flex" style="display: none" >--}}
{{--    <div class="mt-10 mr-5 w-20">--}}
{{--        <span>monday</span>--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            open hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="open[monday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            close hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="close[monday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="weekDay w-full px-3 sm:w-1/2 flex" style="display: none" >--}}
{{--    <div class="mt-10 mr-5 w-20">--}}
{{--        <span>tuesday</span>--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            open hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="open[tuesday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            close hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="close[tuesday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="weekDay w-full px-3 sm:w-1/2 flex" style="display: none" >--}}
{{--    <div class="mt-10 mr-5 w-20">--}}
{{--        <span>wednesday</span>--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            open hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="open[wednesday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            close hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="close[wednesday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="weekDay w-full px-3 sm:w-1/2 flex" style="display: none" >--}}
{{--    <div class="mt-10 mr-5 w-20">--}}
{{--        <span>thursday</span>--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            open hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="open[thursday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            close hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="close[thursday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="weekDay w-full px-3 sm:w-1/2 flex" style="display: none" >--}}
{{--    <div class="mt-10 mr-5 w-20">--}}
{{--        <span>friday</span>--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            open hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="open[friday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            close hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="close[friday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="weekDay w-full px-3 sm:w-1/2 flex" style="display: none" >--}}
{{--    <div class="mt-10 mr-5 w-20">--}}
{{--        <span>Saturday</span>--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            open hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="open[saturday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--    <div class="mb-5">--}}
{{--        <label--}}
{{--            for="time"--}}
{{--            class="mb-3 block text-base font-medium text-[#07074D]"--}}
{{--        >--}}
{{--            close hour--}}
{{--        </label>--}}
{{--        <input--}}
{{--            type="time"--}}
{{--            name="close[saturday]"--}}
{{--            id="time"--}}
{{--            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"--}}

{{--        />--}}
{{--    </div>--}}
{{--</div>--}}
