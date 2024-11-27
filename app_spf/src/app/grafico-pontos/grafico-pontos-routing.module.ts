import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { GraficoPontosPage } from './grafico-pontos.page';

const routes: Routes = [
  {
    path: '',
    component: GraficoPontosPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class GraficoPontosPageRoutingModule {}
