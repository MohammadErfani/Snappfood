<x-restaurant-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
            Report
        </h2>
    </x-slot>
    <div class="flex">
        <div class="flex"><h2 class="font-bold text-2xl ml-5  text-blue-800">Order Count:</h2> <span class="text-blue-900 ml-3 text-lg ">{{count($orders)}}</span></div>
        <div class="flex"><h2 class="font-bold text-2xl ml-48  text-blue-800">Total Sale: </h2><span class="text-blue-900 ml-3 text-lg ">{{$orders->sum('total_price')}}</span></div>
    <a href="{{route('restaurant.report.export')}}" class="bg-blue-600 ml-32 text-green-300 text-2xl font-bold px-3 rounded">Export</a>
    </div>
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
                    <td class="py-4 px-6 text-xl">
                        @foreach($order->foods as $food)
                            <a
                                href="{{route('restaurant.order.show',$order->id)}}">{{$food->name}} {{$order->foodCounts()[$food->id]}}</a><br>
                        @endforeach
                    </td>
                    <td class="py-4 px-6 text-xl">
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

