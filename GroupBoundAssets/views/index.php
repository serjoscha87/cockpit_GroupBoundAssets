<div>
    <ul class="uk-breadcrumb">
        <li class="uk-active"><span>[mod] @lang('Assets')</span></li>
    </ul>
</div>

<div riot-view>
    <cp-assets>

        <script>
            //this.tags['cp-assets'].tpl = 'test';
            //console.info("this outer",this);

            this.on('mount', function(a,b,c,d,e,f,g,h) {

                console.info("this mount", this);

                //console.info(this.tags.child);

                //console.info(a,b,c,d,e,f,g,h);

                //var foo = this;
                /*setTimeout(function() {
                    console.info(">>",foo.listAssets);
                }, 800);*/
                //console.info("mounted");
                //console.info(this.listAssets);
                //console.info(this.tags['cp-assets'].listAssets);

                var orig = this.tags['cp-assets'].listAssets;

                //console.info($(this.tags['cp-assets'].root).find('strong'));
                /*$.each($(this.tags['cp-assets'].root).find('strong'), function (){
                    $(this).append('!!!');
                });*/

                this.tags['cp-assets'].listAssets = function(page) {

                    //console.info(page);

                    console.info("!listAssets hook!");

                    console.info("from within listAssets:", this);

                    console.info("strongs.. ",$(this.root).find('strong'));

                    orig.apply(this);

                    console.info("strongs.. ",$(this.root).find('strong'));

                    /*$.each($(this.root).find('strong'), function (){
                        $(this).append('!!!');
                    });*/


                    /*this.page    = page || 1;
                    this.loading = true;

                    var options = {
                        filter : this.filter || null,
                        limit  : this.limit,
                        skip: (this.page - 1) * this.limit,
                        sort: {created: -1}
                    };

                    App.request('/assetsmanager/listAssets', options).then(function (response) {

                        $this.assets = Array.isArray(response.assets) ? response.assets : [];
                        $this.count = response.count || 0;
                        $this.pages = Math.ceil($this.count / $this.limit);
                        $this.loading = false;
                        $this.selected = [];
                        $this.update();
                    });*/

                }.bind(this);

                /*$(document).ready(function(){
                    console.info("!!!!!!!!!");
                    console.info(foo.listAssets);
                });*/

            });
            //console.info(this);

            //console.info(this.listAssets);

            /*$(document).ready(function(){
                console.info("!!!!!!!!!");
            });*/

            /*var bar = this;
            $(document).ready(function(){
                console.info("!!!!!!!!!");
                console.info(bar.listAssets);
            });*/

        </script>

    </cp-assets>
</div>
