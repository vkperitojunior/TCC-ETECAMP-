import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { GraficoEficienciaPage } from './grafico-eficiencia.page';

const routes: Routes = [
  {
    path: '',
    component: GraficoEficienciaPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class GraficoEficienciaPageRoutingModule {}
