import { ComponentFixture, TestBed } from '@angular/core/testing';
import { GraficoPontosPage } from './grafico-pontos.page';

describe('GraficoPontosPage', () => {
  let component: GraficoPontosPage;
  let fixture: ComponentFixture<GraficoPontosPage>;

  beforeEach(() => {
    fixture = TestBed.createComponent(GraficoPontosPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
