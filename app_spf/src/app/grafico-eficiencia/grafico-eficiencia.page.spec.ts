import { ComponentFixture, TestBed } from '@angular/core/testing';
import { GraficoEficienciaPage } from './grafico-eficiencia.page';

describe('GraficoEficienciaPage', () => {
  let component: GraficoEficienciaPage;
  let fixture: ComponentFixture<GraficoEficienciaPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(GraficoEficienciaPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
