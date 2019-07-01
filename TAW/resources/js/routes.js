// import Vue from 'vue'
// import Router from 'vue-router'
import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import categorias from './components/categoriasComponent.vue'
import articulos from './components/articulosComponent.vue'
import ingresos from './components/ingresosComponent.vue'
import proveedores from './components/proveedoresComponent.vue'
import ventas from './components/ventasComponent.vue'
import clientes from './components/clientesComponent.vue'

export default new Router({   
	routes: [
		{
			path: '/',
			name: 'home',
			component: categorias
		},
		{
			path: '/categorias',
			name: 'categorias',
			component: categorias
		},
		{
			path: '/articulos',
			name: 'articulos',
			component: articulos
		},
		{
			path: '/ingresos',
			name: 'ingresos',
			component: ingresos
		},
		{
			path: '/proveedores',
			name: 'proveedores',
			component: proveedores
		},
		{
			path: '/ventas',
			name: 'ventas',
			component: ventas
		},
		{
			path: '/clientes',
			name: 'clientes',
			component: clientes
		}
	],
	mode: 'history'//,
	// scrollBehavior() {
	// 	return {x:0, y:0}
	// }
})