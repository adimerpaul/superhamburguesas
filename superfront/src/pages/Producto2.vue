<template>
  <div class="q-pa-xs">
  <div class="row">
    <div class="col-12">
      <q-card>
        <q-tabs
          v-model="tab"
          dense
          class="text-grey"
          active-color="primary"
          indicator-color="primary"
          align="justify"
          narrow-indicator
        >
          <q-tab  @click="productos(r)" v-model="rubro" v-for="(r,i) in rubros" :key="i" :name="r.id" :label="r.nombre" />
<!--          <q-tab name="alarms" label="Alarms" />-->
<!--          <q-tab name="movies" label="Movies" />-->
        </q-tabs>
        <q-separator />
        <q-tab-panels v-model="tab" animated>
          <q-tab-panel v-for="(r,i) in rubros" :name="r.id" :key="i">
            <div class="text-h6">Mails</div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </q-tab-panel>

<!--          <q-tab-panel name="alarms">-->
<!--            <div class="text-h6">Alarms</div>-->
<!--            Lorem ipsum dolor sit amet consectetur adipisicing elit.-->
<!--          </q-tab-panel>-->

<!--          <q-tab-panel name="movies">-->
<!--            <div class="text-h6">Movies</div>-->
<!--            Lorem ipsum dolor sit amet consectetur adipisicing elit.-->
<!--          </q-tab-panel>-->
        </q-tab-panels>
      </q-card>
    </div>
  </div>
  </div>
</template>

<script>
import {date} from "quasar";
export default {
  data () {
    return{
      tab:1,
      rubros:[],
      rubro:''
    }
  },
  created() {
    this.misrubros();
  },
  methods:{
   misrubros(){
     this.$q.loading.show()
     this.$axios.get(process.env.API+'/rubro').then(res=>{
       // console.log(res.data)
       this.rubros=res.data
       this.$q.loading.hide()
       // this.$axios.get('')
     })
   },
    productos(value){
     // console.log(value)
     //  console.log(this.rubros.find(r=>r.id===1))
    }
  }
}
</script>
