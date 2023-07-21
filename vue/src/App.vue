<template>
    <main>
        <div id="widget-area">
          <div id="widget-header">
              <div class="widget-header-cell">
                  <span class="label">Symbol</span>
              </div>
              <div class="widget-header-cell right">
                  <span class="label">Price</span>
              </div>
              <div class="widget-header-cell right">
                  <span class="label">Volume</span>
              </div>
          </div>
          <div id="widget-body">
              <div v-for="ticker in tickers" class="widget-row-line">
                  <div class="widget-row-block">
                      <span class="ticker-data bold">{{ ticker.symbol }}</span>
                  </div>
                  <div class="widget-row-block right">
                      <span class="ticker-data">{{ ticker.price }}</span>
                  </div>
                  <div class="widget-row-block right">
                      <span class="ticker-data">{{ ticker.volume }}</span>
                  </div>
              </div>
          </div>
        </div>
  </main>
</template>


<script>
export default {
    name: 'App',
    data() {
        return {
            connection: null,
            tickers: []
        }
    },
    created: function() {
        let connection = new WebSocket("ws://127.0.0.1:8001", []);

        let instance = this;
        connection.onmessage = function(event) {
            let data = JSON.parse(event.data);

            let index = instance.tickers.findIndex((ticker) => ticker.symbol == data.symbol);
            if (index >= 0) {
                instance.tickers[index] = data;
            } else {
                instance.tickers.push(data);
            }

            console.log(index);
        };

        this.connection = connection;
    },
}
</script>