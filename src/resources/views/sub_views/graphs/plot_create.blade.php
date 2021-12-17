<div class="col-12 col-md-12 col-lg-3 col-xl-4">
    <div class="card overflow-auto px-0 px-sm-3 px-md-5 px-lg-0 px-xl-3">
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
                    <a v-if="!modalBodyContent" class="nav-link passiveContent" id="plot-tab" :data-toggle="sideNavTab"
                        href="#plot" role="tab" aria-controls="plot" aria-selected="false"
                        v-on:click="switchContent(false, true, false)"
                        >
                        プロット
                    </a>
                    <a v-if="modalBodyContent" class="nav-link passiveContent" id="plot-tab" data-toggle="modal"
                        data-target="#axisModalWarning" href="#plot" role="tab"
                        aria-controls="plot" aria-selected="false"
                        v-on:click="switchContent(false, true, false)"
                        >
                        プロット
                    </a>
                </li>
                <li class="nav-item">
                    <a v-if="!modalBodyContent" class="nav-link passiveContent" id="save-tab" :data-toggle="sideNavTab"
                        href="#save" role="tab" aria-controls="save" aria-selected="false"
                        v-on:click="switchContent(false, true, true)"
                        >
                        保存
                    </a>
                    <a v-if="modalBodyContent" class="nav-link passiveContent" id="save-tab" data-toggle="modal"
                        data-target="#axisModalWarning" href="#save" role="tab"
                        aria-controls="save" aria-selected="false"
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

                <!-- Central Modal Medium Warning -->
                <div v-if="modalBodyContent" class="modal fade" id="axisModalWarning" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-notify modal-warning" role="document">
                        <!--Content-->
                        <div class="modal-content">
                        <!--Header-->
                            <div class="modal-header">
                                <p class="heading lead ml-3">確認</p>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="white-text">&times;</span>
                                </button>
                            </div>

                            <!--Body-->
                            <div class="modal-body">
                                <div class="text-center">
                                    <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
                                    <p v-html="modalBodyContent"></p>
                                </div>
                            </div>

                            <!--Footer-->
                            <div class="modal-footer justify-content-center" role="group" aria-label="modal-button">
                                <button type="button" class="py-2 mr-4 btn btn-outline-warning" data-dismiss="modal">OK</button>
                            </div>
                        <!--/.Content-->
                        </div>
                    </div>
                </div>
                <!-- Central Modal Medium Warning-->

            </div>


        </div>

    </div>
</div>

