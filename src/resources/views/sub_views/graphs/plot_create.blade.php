<div class="col-12 col-lg-3">
    <div class="card overflow-auto">
        <div class="card-body graph-sidebar-card w-100">
            <ul class="nav nav-tabs nav-pills graph-nav-pills" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active passiveContent" id="axis-tab" data-toggle="tab"
                        href="#axis" role="tab" aria-controls="axis" aria-selected="true"
                        v-on:click="switchContent(true, false, false)"
                        >
                        軸設定
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link passiveContent" id="plot-tab" :data-toggle="sideNavTab"
                        href="#plot" role="tab" aria-controls="plot" aria-selected="false"
                        v-on:click="switchContent(false, true, false)"
                        >
                        プロット
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link passiveContent" id="save-tab" :data-toggle="sideNavTab"
                        href="#save" role="tab" aria-controls="save" aria-selected="false"
                        v-on:click="switchContent(false, true, true)"
                        >
                        保存
                    </a>
                </li>
            </ul>


            <div class="tab-content" id="myTabContent">

                {{-- 軸設定タブの内容 --}}
                <div class="tab-pane fade show active" id="axis" role="tabpanel" aria-labelledby="axis-tab">
                    @include('components.graphs.axis_set_nav')
                </div>

                {{-- グラフプロットタブ --}}
                <div class="tab-pane fade" id="plot" role="tabpanel" aria-labelledby="plot-tab">
                    @include('components.graphs.graph_plot')
                </div>

                {{-- 保存タブ --}}
                <div class="tab-pane fade" id="save" role="tabpanel" aria-labelledby="save-tab">
                    @include('components.graphs.graph_save')
                </div>

            </div>


        </div>

    </div>
</div>

