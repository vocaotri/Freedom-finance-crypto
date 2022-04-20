var cryptos = $('#main-crypto tr');
$.each(cryptos, function (index, value) {
    var symbol = $(value).find('td:eq(0)');
    var totalCoin = $(value).find('td:eq(3)');
    var totalUsdt = $(value).find('td:eq(5)');
    var currentPrice = $(value).find('td:eq(6)');
    var socket = new WebSocket('wss://stream.binance.com:9443/stream?streams=' + symbol.text()
        .toLowerCase() + 'usdt@trade');
    socket.onopen = function (event) {
        console.log('listen web socket binance by symbol ' + symbol.text() + 'USDT');
    };
    socket.onmessage = function (event) {
        var {
            data
        } = JSON.parse(event.data);
        var price = parseFloat(data.p);
        var total_usdt = parseFloat(totalCoin.text()) * price;
        price = price.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
        currentPrice.text(price);
        total_usdt = total_usdt.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
        totalUsdt.text('$' + total_usdt);
        updateTotalUSDT();
    };
});

function updateTotalUSDT() {
    var total_usdt = 0;
    var elTotalUsdt = $('#total_usdt');
    var elTotalMain = $('#total_usdt_main');
    $.each(cryptos, function (index, value) {
        var totalUsdt = $(value).find('td:eq(5)');
        total_usdt += parseFloat(totalUsdt.text().replace('$', '').replace(',', ''));
    });
    // number format total usdt us
    total_usdt = total_usdt.toLocaleString('us', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
    elTotalUsdt.text('$' + total_usdt);
    if (elTotalMain.length > 0) {
        elTotalMain.text(elTotalUsdt.text());
    }
}
