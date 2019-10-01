<template>
    <div>
        <h2>Permohonans work</h2>
    </div>
</template>

<script>
export default {
    data() {
        return {
            permohonans : [],
            permohonans : {
                permohonan_id : '',
                doc_title : '',
                jenis_permohonan_id : '',
                id_penghantar : '',
                status_permohonan_id : '',
                created_at : '',
                updated_at : '',
            }
        }
    },

    created(){
        this.fetchPermohonans();
    },

    methods : {
        fetchPermohonans(){
            fetch('api/permohonan_dihantar').then(res => res.json()).then(res =>{console.log(res);})
        }
    }

}
</script>