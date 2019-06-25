// import Vue from 'vue'
// import Router from 'vue-router'
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({    
	routes: [
		{
			path: '/a',
			name: 'home',
			component: require('./components/categoriasComponent.vue').default
		},
		{
			path: '/',
			name: 'articulos',
			component: require('./components/categoriasComponent.vue').default
		}
	],
	mode: 'history'//,
	// scrollBehavior() {
	// 	return {x:0, y:0}
	// }
})