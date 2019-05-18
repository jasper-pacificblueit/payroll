<script>
	  function newsapi(country = 'ph', apikey = '700c63acbba14b8ba8b9744c4a7c8d99') {

    var newsapiDetails = document.querySelector(".newsapi-details");

    fetch (`https://newsapi.org/v2/top-headlines?country=${country}&apiKey=${apikey}`).then(rep => rep.json()).then(json => {

      console.log(json);
      var newsfeed = document.querySelector("#newsapi");

      newsfeed.innerHTML = "";

      json.articles.forEach(news => {
        if (news.urlToImage == null) return;
        console.log(news);

        var div = document.createElement("div");

        div.setAttribute("id", news.source.name);

        news.publishedAt = new Date(news.publishedAt);
        today = new Date();

        var pub = ((today - news.publishedAt)/1e3/3600).toFixed(0) + ` hour${((today - news.publishedAt)/1e3/3600).toFixed(0) >= 1?'s':''} ago`;

        div.innerHTML = `
            <div class="col-lg-4 col-sm-4 col-xs-5">
              <img src="${news.urlToImage}" class="img-responsive" height=470 style="margin: auto; height: 150px; padding-top: 10px; padding-bottom: 10px ">
            </div>
            <div class="col-lg-8 no-padding">
              <h3><a href="${news.url}" class="no-padding">${news.title}</a><br><small class="text-muted no-padding">${pub}</small></h3>
              <label>Description</label>
              <p>${news.content || news.description}</p>
            </div>
          </div>
        `;

        newsfeed.appendChild(div);
      });

      $("#newsapi").on("init", function(event, slick) {
        newsapiDetails.innerHTML = `
          Source: <label><a href="http://${document.querySelector('.slick-current')}">${document.querySelector('.slick-current').id}</a></label>
          <span class="pull-right"><i class="fas fa-rss-square"></i> NewsAPI</span>
        `;
      });

      $("#newsapi").slick({
        autoplay: true,
      });

      $("#newsapi").on("afterChange", function(event, slick) {
        newsapiDetails.innerHTML = `
          Source: <label><a href="http://${document.querySelector('.slick-current').id}">${document.querySelector('.slick-current').id}</a></label>
          <span class="pull-right"><i class="fas fa-rss-square"></i> NewsAPI</span>
        `;
      });
    });

  }
</script>