import { Component, OnInit, ViewChild, ElementRef, AfterViewInit } from '@angular/core';
import { NavController, MenuController } from '@ionic/angular';
import { ApiService } from '../services/api.service';
import { Chart, LinearScale, BarElement, Title, Tooltip, Legend, BarController, CategoryScale } from 'chart.js';

// Registrar os componentes necessários
Chart.register(LinearScale, BarElement, Title, Tooltip, Legend, BarController, CategoryScale);

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage implements OnInit, AfterViewInit {
  menuType: string = 'overlay';
  selectedYear: number = new Date().getFullYear(); // Seleciona o ano atual
  selectedNewsId: number | null = null; // Para armazenar o ID da notícia selecionada
  selectedTema: any; // Para armazenar o tema selecionado
  years: number[] = [2022, 2023, 2024];

  // Dados da notícia
  latestNews: any[] = []; // Para armazenar as últimas notícias
  selectedNews: any; // Para armazenar os detalhes da notícia selecionada
  showTable: string | null = null;
  DarkMode: boolean = false;

  // Dados que vamos buscar da API
  equipes: any[] = [];
  gincanas: any[] = [];
  temas: any[] = [];
  usuarios: any[] = [];
  pontuacoes: any[] = []; // Para armazenar as pontuações por equipe
  chartInstance: any; // Para armazenar a instância do gráfico

  @ViewChild('topContent', { static: false }) topContent!: ElementRef;
  @ViewChild('tabelaEquipes', { static: false }) tabelaEquipes!: ElementRef;
  @ViewChild('tabelaPontos', { static: false }) tabelaPontos!: ElementRef;
  @ViewChild('tabelaLocais', { static: false }) tabelaLocais!: ElementRef;
  @ViewChild('tabelaOrganizadores', { static: false }) tabelaOrganizadores!: ElementRef;
  @ViewChild('tabelaGraficoPontos', { static: false }) tabelaGraficoPontos!: ElementRef;
  @ViewChild('tabelaGraficoEficiencia', { static: false }) tabelaGraficoEficiencia!: ElementRef;
  @ViewChild('myChart', { static: false }) myChart!: ElementRef; // Referência para o canvas do gráfico

  constructor(private navCtrl: NavController, private menuController: MenuController, private apiService: ApiService) {}

  ngOnInit() {
    this.initializeTheme();
    this.loadData(); // Carregar dados da API ao inicializar
  }

  ngAfterViewInit() {
    if (this.showTable === 'equipes') {
      this.createChart(); // Chame o método para criar o gráfico
    }
  }

  initializeTheme() {
    const darkModeEnabled = document.documentElement.getAttribute('data-theme') === 'dark';
    this.DarkMode = darkModeEnabled;
  }

  toggleDarkMode() {
    this.DarkMode = !this.DarkMode; // Alterna o estado
    document.documentElement.setAttribute('data-theme', this.DarkMode ? 'dark' : 'light');
  }

  scrollToTop() {
    this.topContent.nativeElement.scrollIntoView({ behavior: 'smooth' });
  }

  get modeText() {
    return this.DarkMode ? 'Modo Claro' : 'Modo Escuro';
  }

  toggleTable(tableName: string) {
    this.showTable = this.showTable === tableName ? null : tableName;
    console.log(`Tabela exibida: ${this.showTable}`);

    if (tableName === 'equipes') {
      setTimeout(() => {
        this.loadPontuacoes(); // Carrega as pontuações ao exibir a tabela
      }, 200);
    }

    setTimeout(() => {
      this.scrollToTable(tableName);
    }, 200);
  }

  scrollToTable(tableName: string) {
    switch (tableName) {
      case 'equipes':
        this.tabelaEquipes.nativeElement.scrollIntoView({ behavior: 'smooth' });
        break;
      case 'locais':
        this.tabelaLocais.nativeElement.scrollIntoView({ behavior: 'smooth' });
        break;
      case 'inf_equipes':
        this.tabelaGraficoPontos.nativeElement.scrollIntoView({ behavior: 'smooth' });
        break;
      case 'organizadores':
        this.tabelaOrganizadores.nativeElement.scrollIntoView({ behavior: 'smooth' });
        break;
    }
  }

  equipesDetalhadas: any[] = [];
  organizadores: any[] = []; // Para armazenar os organizadores

  // Método para carregar dados da API
  loadData() {
    this.apiService.getEquipes().subscribe((data) => {
      this.equipes = data;
      this.equipesDetalhadas = data; // Armazena os detalhes das equipes
      console.log('Equipes:', this.equipes);
      console.log('Equipes Detalhadas:', this.equipesDetalhadas);
    });

    this.apiService.getGincanas().subscribe((data) => {
      this.gincanas = data;
      console.log('Gincanas:', this.gincanas);
    });

    this.apiService.getNoticias().subscribe((data) => {
      this.latestNews = data.slice(0, 3); // Obtenha as últimas 3 notícias
      this.selectedNewsId = this.latestNews.length > 0 ? this.latestNews[0].id_not : null; // Seleciona a última notícia
      this.updateSelectedNews(); // Atualiza os dados da notícia selecionada
      console.log('Últimas Notícias:', this.latestNews);
    });

    this.apiService.getTemas().subscribe((data) => {
      this.temas = data;
      console.log('Temas:', this.temas); // Verifique se os temas estão sendo carregados corretamente
      // Inicializa o tema selecionado automaticamente
      this.fetchYearData(); 
    });

    this.apiService.getUsuarios().subscribe((data) => {
      this.usuarios = data;
    });

    this.apiService.getOrganizadores().subscribe((data) => {
      this.organizadores = data;
      console.log('Organizadores:', this.organizadores);
    });
  }

  // Método para carregar pontuações por equipe
  loadPontuacoes() {
    this.apiService.getPontuacoesPorEquipe().subscribe((data) => {
      this.pontuacoes = data;
      console.log('Pontuações:', this.pontuacoes); // Log dos dados recebidos
      this.createChart(); // Chama a função para criar o gráfico ao receber os dados
    });
  }

  // Método para navegar para a página de Tarefas
  navigateToTarefas() {
    console.log('Navegando para Tarefas');
    this.navCtrl.navigateRoot('tarefas');
  }

  openMenu() {
    this.menuController.open(); // Abre o menu
  }

  closeMenu() {
    this.menuController.close(); // Fecha o menu
  }

  //--------------------------------
  // Chart.ts - Tabelas

  getNomeEquipe(equipeId: number): string {
    const equipe = this.equipes.find(e => e.id_eq === equipeId);
    return equipe ? equipe.nome_eq : 'Desconhecida';
  }

  // Defina um array de cores que você deseja usar
  private colors: string[] = [
    'rgba(255, 99, 132, 0.5)', // Rosa
    'rgba(54, 162, 235, 0.5)', // Azul
    'rgba(255, 206, 86, 0.5)', // Amarelo
    'rgba(75, 192, 192, 0.5)', // Verde água
    'rgba(153, 102, 255, 0.5)', // Roxo
    'rgba(255, 159, 64, 0.5)', // Laranja
  ];

  createChart() {
    const ctx = this.myChart.nativeElement.getContext('2d'); // Use a referência do canvas

    // Limpar o gráfico existente se houver
    if (this.chartInstance) {
      this.chartInstance.destroy();
    }

    // Preparar os dados do gráfico
    const labels = this.pontuacoes.map(p => this.getNomeEquipe(p.equipe_id)); // Nomes das equipes
    const data = this.pontuacoes.map(p => p.total_pontos); // Pontos totais

    console.log('Labels do Gráfico:', labels); // Log dos rótulos
    console.log('Dados do Gráfico:', data); // Log dos dados

    // Verifica se há dados para criar o gráfico
    if (labels.length === 0 || data.length === 0) {
      console.warn('Nenhum dado disponível para o gráfico.');
      return; // Não cria o gráfico se não houver dados
    }

    // Criação de cores aleatórias para cada equipe
    const backgroundColors = this.pontuacoes.map((_, index) => {
      return this.colors[index % this.colors.length]; // Seleciona uma cor do array baseado no índice
    });

    this.chartInstance = new Chart(ctx, {
      type: 'bar', // Tipo de gráfico
      data: {
        labels: labels,
        datasets: [{
          label: 'Pontuações por Equipe',
          data: data,
          backgroundColor: backgroundColors, // Usar as cores geradas
          borderColor: backgroundColors.map(color => color.replace('0.5', '1')), // Alterar a opacidade para a borda
          borderWidth: 1
        }]
      },
      options: {
        indexAxis: 'y', // Configuração para gráfico horizontal
        scales: {
          x: {
            beginAtZero: true
          }
        }
      }
    });
  }

  fetchYearData() {
    this.selectedTema = this.temas.find(tema => Number(tema.motivacao_tm) === this.selectedYear);
  }

  // Método para selecionar uma notícia
  selectNews(newsId: number) {
    this.selectedNewsId = newsId; // Armazena o ID da notícia selecionada
    this.updateSelectedNews(); // Atualiza a notícia selecionada
  }
  
  updateSelectedNews() {
    if (this.selectedNewsId) {
      this.selectedNews = this.latestNews.find(news => news.id_not === this.selectedNewsId);
      console.log('Notícia Selecionada:', this.selectedNews);
    }
  }
  
  // Método para exibir dados da notícia selecionada
  fetchNewsData() {
    if (this.selectedNewsId) {
      const selectedNews = this.latestNews.find(news => news.id_not === this.selectedNewsId);
      if (selectedNews) {
        console.log(`Título: ${selectedNews.titulo_not}`);
        console.log(`Descrição: ${selectedNews.descricao_not}`);
        console.log(`Data: ${selectedNews.data_not}`);
      }
    }
  }
}
