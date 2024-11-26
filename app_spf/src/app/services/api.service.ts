import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = 'http://192.168.12.167/spf.com/backend/conexao/script/api.php';

  constructor(private http: HttpClient) {}

  getEquipes(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=equipes`);
  }

  getGincanas(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=gincanas`);
  }

  getNoticias(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=ultimas_noticias`); // Alterado para obter as últimas notícias
  }

  getTemas(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=temas`);
  }

  getUsuarios(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=usuarios`);
  }

  getPontuacoesPorEquipe(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=pontuacoes_por_equipe`);
  }

  getEquipesDetalhadas(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=equipes`);
  }

  getOrganizadores(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=organizadores`);
  }

  getUltimasNoticias(): Observable<any> {
    return this.http.get(`${this.apiUrl}?action=ultimas_noticias`); // Novo método para obter as últimas notícias
  }
}
