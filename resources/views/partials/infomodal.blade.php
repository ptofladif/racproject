<!-- Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModal" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <i v-if="type == 'warning'" class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                    <i v-if="type == 'success'" class="fas fa-check fa-2x text-success"></i>
                    <i v-if="type == 'info'" class="fas fa-info fa-2x text-info"></i>
                    @{{ title }}
                </div>
                <span class="pull-right">
                    <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </span>
            </div>

            <div class="modal-body">
                <div v-if="type == 'warning'" class="text-danger"><span v-html="body"></span></div>
                <div v-else><span v-html="body"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var infoModalVM = new Vue({
        el: '#infoModal',
        data: {
            title:'',
            body:'',
            type:''
        }
    });
</script>
