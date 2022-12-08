<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            Report
        </h2>
    </x-slot>
    <div class="flex">
        <div class="flex"><h2 class="font-bold text-xl ml-2  text-blue-800">Order Count:</h2> <span class="text-blue-900 ml-1 text-lg ">{{count($orders)}}</span></div>
        <div class="flex"><h2 class="font-bold text-xl ml-5  text-blue-800">Total Sale: </h2><span class="text-blue-900 ml-1 text-lg ">{{$orders->sum('total_price')}}</span></div>
        <form action="{{route('restaurant.report.filterYear')}}" method="post" class="ml-10">
            @csrf
            <input name="year" type="number" step="1" value="{{$year??''}}" min="2000" max="{{now()->year}}" class="rounded-md border border-[#e0e0e0] bg-white  px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md " >
            <button type="submit" class="bg-purple-600 text-green-300 rounded  font-bold px-2 py-1"> Filter By Year</button>
        </form>
        <form action="{{route('restaurant.report.filterBetween')}}" method="post" class="ml-10">
            @csrf
            <input name="start" type="date" value="{{$start??''}}" step="1" class="rounded-md border border-[#e0e0e0] bg-white  px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md " >
            <input name="end" type="date" value="{{$end??''}}" step="1" class="rounded-md border border-[#e0e0e0] bg-white  px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md " >
            @if ($errors->any())
                <div class="mt-3 bg-red-50 border border-red-500 text-red-900  text-sm rounded-lg ">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="bg-purple-600 text-green-300 rounded  font-bold px-2 py-1 items-center"> Filter Between</button>
        </form>
    </div>
    <div class="mt-2"><a href="{{route('restaurant.report.export')}}" class="bg-purple-600 ml-2 text-green-300 text-lg font-bold px-3 py-1 rounded">Export Excel</a></div>
        <table class="w-5/6  text-left text-green-800 font-extrabold dark:text-gray-400 mt-3 w-1/2">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6 text-xl">Food with count</th>
                <th scope="col" class="py-3 px-6 text-xl">Order Price</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order )
                <tr>
                    <td class="py-4 px-6 text-lg">
                        @foreach($order->foods as $food)
                            <a
                                href="{{route('restaurant.order.show',$order->id)}}">{{$food->name}} {{$order->foodCounts()[$food->id]}}</a><br>
                        @endforeach
                    </td>
                    <td class="py-4 px-6 text-lg">
                        <a href="{{route('restaurant.order.show',$order->id)}}">{{$order->total_price}}</a>
                    </td>
                </tr>
            @empty
                <p>There is no Order to show</p>
            @endforelse
            </tbody>
        </table>

    <div class="w-2/3">
        <canvas id="countChart" height="100px"></canvas>
    </div>
    <div class="w-2/3">
        <canvas id="priceChart" height="100px"></canvas>
    </div>
</x-restaurant-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">

    var countLabels = {{ Js::from($countLabel) }};
    var countDatas = {{ Js::from($countData) }};
    var priceLabels = {{ Js::from($priceLabel) }};
    var priceDatas = {{ Js::from($priceData) }};

    const countData = {
        labels: countLabels,
        datasets: [{
            label: 'Order Counts',
            backgroundColor: 'rgb(27,170,57)',
            borderColor: 'rgb(255, 99, 132)',
            data: countDatas,
        }]
    };
    const priceData = {
        labels: priceLabels,
        datasets: [{
            label: 'Order Price',
            backgroundColor: 'rgb(255,162,24)',
            borderColor: 'rgb(255, 99, 132)',
            data: priceDatas,
        }]
    };

    const config1 = {
        type: 'bar',
        data: countData,
        options: {}
    };

    const countChart = new Chart(
        document.getElementById('countChart'),
        config1
    );
    const config2 = {
        type: 'bar',
        data: priceData,
        options: {}
    };

    const priceChart = new Chart(
        document.getElementById('priceChart'),
        config2
    );
</script>

