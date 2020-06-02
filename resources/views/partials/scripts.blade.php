<!-- js: vendor -->
<script src="{{ asset_cdn('js/theme.js?v=' . config('version.app_tag') ) }}"></script>

<!-- js: plugins -->
<script>
  $(function() {
    $('.easypiechart').easyPieChart();
  });
</script>

<!-- theme settings -->
<script>
  var gameforest = {
    disqus: 'gameforestyakuzieu',
    facebook: {
      lang: 'en_US',
      version: 'v3.2',
      id: '',
    }
  }
</script>
@yield('js')
