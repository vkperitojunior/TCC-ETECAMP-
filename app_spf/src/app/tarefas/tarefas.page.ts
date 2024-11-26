import { Component } from '@angular/core'; // Importa a classe Component do Angular
import { ToastController } from '@ionic/angular'; // Importa o ToastController do Ionic para mostrar mensagens
import { NavController } from '@ionic/angular'; // Importa o NavController para navegação
import { ModalController } from '@ionic/angular'; // Importa o ModalController para gerenciar modais

// Define a interface Task para representar uma tarefa
interface Task {
  name: string; // Nome da tarefa
  category: string; // Categoria da tarefa (AFazer, emAndamento, finalizada)
  dueDate: string; // Data de vencimento da tarefa no formato dd/mm/aaaa
}

@Component({
  selector: 'app-tarefas', // Seletor do componente
  templateUrl: './tarefas.page.html', // HTML do componente
  styleUrls: ['./tarefas.page.scss'], // Estilos do componente
})
export class TarefasPage {
  newTask: string = ''; // Armazena o título da nova tarefa
  dueDate: string = ''; // Armazena a data de vencimento da nova tarefa
  tasks: Task[] = []; // Array que contém as tarefas
  error: string = ''; // Mensagem de erro
  selectedFilters: string[] = ['AFazer', 'emAndamento', 'finalizada']; // Filtros selecionados
  showConfigMenu: boolean = false; // Controla a exibição do menu de configuração

  constructor(private toastController: ToastController, private navController: NavController) {
    this.loadTasks(); // Carrega as tarefas do localStorage ao inicializar
  }

  // Navega de volta para a página inicial
  goHome() {
    this.navController.navigateBack('/home');
  }

  // Adiciona uma nova tarefa
  addTask() {
    this.error = ''; // Limpa mensagens de erro
  
    // Verifica se o título da tarefa está vazio
    if (this.newTask.trim() === '') {
      this.error = 'Título: Por favor, insira um título para a tarefa.';
      return; // Sai da função se não houver título
    }
  
    // Formata a data de vencimento antes de usá-la
    this.dueDate = this.formatDueDate();
  
    // Se a data formatada estiver vazia, exibe um erro e sai da função
    if (!this.dueDate) {
      this.error = 'Data: Por favor, insira uma data válida.';
      return; 
    }
  
    // Valida a data de vencimento
    const isValidDate = this.validateDate(this.dueDate);
    if (!isValidDate) {
      return; // Sai da função se a data não for válida
    }
  
    // Cria um objeto de tarefa
    const task: Task = {
      name: this.newTask,
      category: 'AFazer', // Define a categoria como "AFazer"
      dueDate: this.dueDate, // Armazena a data de vencimento
    };
  
    // Adiciona a nova tarefa à lista
    this.tasks.push(task);
    this.saveTasks(); // Salva as tarefas no localStorage
    this.newTask = ''; // Limpa o campo de entrada
    this.dueDate = ''; // Limpa a data após adicionar a tarefa
  }

  // Valida a data fornecida
  validateDate(dateStr: string): boolean {
    const dateParts = dateStr.split('/'); // Divide a string da data em partes

    // Verifica se a data está no formato correto
    if (dateParts.length !== 3) {
      this.error = 'Data: Por favor, insira uma data válida (DD/MM/AAAA).';
      return false; // Retorna falso se a data não estiver no formato correto
    }

    const day = parseInt(dateParts[0]); // Dia
    const month = parseInt(dateParts[1]); // Mês
    const year = dateParts[2]; // Ano

    const today = new Date(); // Data atual
    const maxYear = today.getFullYear() + 10; // Ano máximo (10 anos a partir de agora)
    const minYear = today.getFullYear() - 5; // Ano mínimo (5 anos para trás)

    // Verifica se o ano é válido
    if (year.length !== 4 || isNaN(parseInt(year))) {
      this.error = 'Data: Ano inválido. A formatação deve ser: dd/mm/aaaa';
      return false;
    }

    const yearNum = parseInt(year); // Converte o ano para número

    // Verifica se o mês é válido
    if (month < 1 || month > 12) {
      this.error = 'Data: Mês inválido. Por favor, insira um mês entre 01 e 12.';
      return false;
    }

    // Verifica se o ano está dentro do intervalo permitido
    if (yearNum < minYear || yearNum > maxYear) {
      this.error = `Data: Ano inválido. O ano deve estar entre ${minYear} e ${maxYear}.`;
      return false;
    }

    // Verifica se o dia é válido para o mês
    const daysInMonth = new Date(yearNum, month, 0).getDate();
    if (day < 1 || day > daysInMonth) {
      this.error = 'Data: Dia inválido. Insira um dia existente neste mês.';
      return false;
    }

    return true; // Retorna verdadeiro se a data é válida
  }

// Remova ou modifique a função formatInput
formatInput(event: any) {
  const inputValue = event.target.value.replace(/\D/g, ''); // Remove caracteres não numéricos
  this.dueDate = inputValue; // Atualiza a data de vencimento sem formatação
}

// Adicione uma nova função que formata a data no momento do envio
formatDueDate() {
  const inputValue = this.dueDate.replace(/\D/g, ''); // Remove caracteres não numéricos
  let formattedValue = ''; // Armazena o valor formatado

  // Adiciona barras à data
  if (inputValue.length >= 2) {
    formattedValue += inputValue.slice(0, 2) + '/';
  }

  if (inputValue.length >= 4) {
    formattedValue += inputValue.slice(2, 4) + '/';
  }

  if (inputValue.length > 4) {
    formattedValue += inputValue.slice(4, 8);
  }

  return formattedValue; // Retorna a data formatada
}

// Modifique a função addTask para formatar a data antes de adicionar a tarefa




  // Edita a categoria de uma tarefa
  editTask(task: Task) {
    const currentIndex = this.tasks.indexOf(task); // Encontra o índice da tarefa
    if (currentIndex !== -1) {
      // Alterna a categoria da tarefa
      if (task.category === 'AFazer') {
        this.tasks[currentIndex].category = 'emAndamento';
      } else if (task.category === 'emAndamento') {
        this.tasks[currentIndex].category = 'finalizada';
      } else {
        this.tasks[currentIndex].category = 'AFazer';
      }
      this.saveTasks(); // Salva as alterações
    }
  }

  // Remove uma tarefa da lista
  deleteTask(task: Task) {
    const index = this.tasks.indexOf(task); // Encontra o índice da tarefa
    if (index > -1) {
      this.tasks.splice(index, 1); // Remove a tarefa da lista
      this.saveTasks(); // Salva as alterações
    }
  }

  // Formata a categoria da tarefa para exibição
  formatTaskCategory(category: string): string {
    switch (category) {
      case 'AFazer':
        return 'A Fazer'; // Formata para "A Fazer"
      case 'emAndamento':
        return 'Em Andamento'; // Formata para "Em Andamento"
      case 'finalizada':
        return 'Finalizada'; // Formata para "Finalizada"
      default:
        return ''; // Retorna string vazia para categorias desconhecidas
    }
  }

  // Retorna a classe de status da tarefa
  getStatusClass(category: string) {
    return category; // Retorna a categoria para aplicar estilos
  }

  // Carrega as tarefas armazenadas no localStorage
  loadTasks() {
    const tasksJson = localStorage.getItem('tasks'); // Obtém as tarefas do localStorage
    if (tasksJson) {
      this.tasks = JSON.parse(tasksJson); // Converte de JSON para objeto
    }
  }

  // Salva as tarefas no localStorage
  saveTasks() {
    localStorage.setItem('tasks', JSON.stringify(this.tasks)); // Converte objeto em JSON e armazena
  }

  // Limpa a mensagem de erro
  clearError() {
    this.error = ''; // Limpa a mensagem de erro
  }

  // Filtra as tarefas com base nos filtros selecionados
  filteredTasks() {
    console.log('Tasks before filtering:', this.tasks); // Log das tarefas antes da filtragem
    let filtered = this.tasks; // Inicia com todas as tarefas

    // Filtro de cor
    const selectedColorFilters = this.selectedFilters.filter(filter => ['AFazer', 'emAndamento', 'finalizada'].includes(filter));
    
    if (selectedColorFilters.length > 0) {
        filtered = filtered.filter(task => selectedColorFilters.includes(task.category)); // Filtra por categoria
    }

    const today = new Date(); // Obtém a data atual
    const todayString = `${this.pad(today.getDate())}/${this.pad(today.getMonth() + 1)}/${today.getFullYear()}`; // Formato dd/mm/aaaa

    // Filtro "Hoje"
    if (this.selectedFilters.includes('Hoje')) {
        filtered = filtered.filter(task => task.dueDate === todayString); // Filtra tarefas com vencimento hoje
    }

    // Filtro "Próximos 7 dias"
    if (this.selectedFilters.includes('Próximos 7 dias')) {
        const sevenDaysFromNow = new Date();
        sevenDaysFromNow.setDate(today.getDate() + 7); // Define data para 7 dias a partir de hoje
        filtered = filtered.filter(task => {
            const [day, month, year] = task.dueDate.split('/').map(Number); // Divide a data da tarefa
            const dueDate = new Date(year, month - 1, day); // Cria objeto Date para a data da tarefa
            return dueDate >= today && dueDate <= sevenDaysFromNow; // Retorna tarefas que vencem nos próximos 7 dias
        });
    }

    // Filtro "Retroativo"
    if (this.selectedFilters.includes('Retroativo')) {
        const pastDate = new Date();
        pastDate.setDate(today.getDate() - 1); // Define data para um dia antes
        filtered = filtered.filter(task => {
            const [day, month, year] = task.dueDate.split('/').map(Number); // Divide a data da tarefa
            const dueDate = new Date(year, month - 1, day); // Cria objeto Date para a data da tarefa
            return dueDate < pastDate; // Retorna tarefas que venceram antes de ontem
        });
    }

    console.log('Filtered Tasks:', filtered); // Log das tarefas filtradas
    return filtered; // Retorna as tarefas filtradas
  }

  highlightedFilter: string | null = null; // Armazena o filtro em destaque

  // Alterna a seleção de filtros
  toggleFilter(filter: string) {
    if (this.selectedFilters.includes(filter)) {
        this.selectedFilters = this.selectedFilters.filter(f => f !== filter); // Remove o filtro se já estiver selecionado
    } else {
        this.selectedFilters = this.selectedFilters.filter(f => !['Hoje', 'Próximos 7 dias', 'Retroativo'].includes(f)); // Remove filtros de data
        this.selectedFilters.push(filter); // Adiciona o novo filtro
    }

    // Atualiza a lista filtrada
    this.filteredTasks(); // Chama a função para garantir que a lista seja atualizada
  }

  // Destaca o filtro quando o mouse passa sobre ele
  onMouseEnter(filter: string) {
    this.highlightedFilter = filter; // Armazena o filtro em destaque
  }
  
  // Remove o destaque do filtro quando o mouse sai
  onMouseLeave() {
    this.highlightedFilter = null; // Limpa o filtro em destaque
  }

  // Alterna o filtro de cor
  toggleColorFilter(filter: string) {
    const index = this.selectedFilters.indexOf(filter); // Encontra o índice do filtro
    const wasActive = index > -1; // Verifica se o filtro estava ativo
  
    if (wasActive) {
      // Se o filtro "Hoje" ou "Retroativo" estiver ativo, não permite desativar todos os toggles
      if (!this.selectedFilters.includes('Hoje') && !this.selectedFilters.includes('Retroativo')) {
        this.selectedFilters.splice(index, 1); // Remove o filtro ativo
      }
    } else {
      this.selectedFilters.push(filter); // Adiciona o novo filtro
    }
  
    // Verifica se o usuário está tentando desativar mais de dois toggles
    if (!this.selectedFilters.includes('Hoje') && !this.selectedFilters.includes('Retroativo') &&
        this.selectedFilters.filter(f => ['AFazer', 'emAndamento', 'finalizada'].includes(f)).length > 2) {
      // Se sim, reativa todos os toggles
      this.selectedFilters = this.selectedFilters.filter(f => f === 'Hoje' || f === 'Retroativo'); // Mantém apenas "Hoje" e "Retroativo"
      this.selectedFilters.push('AFazer', 'emAndamento', 'finalizada'); // Reativa todos os toggles de cor
      this.animateToggle(); // Anima a reativação
    }
  
    // Se todos os toggles de cor foram desativados
    if (this.selectedFilters.length === 0 || 
        (this.selectedFilters.length === 1 && (this.selectedFilters.includes('Hoje') || this.selectedFilters.includes('Retroativo')))) {
      // Se apenas "Hoje" ou "Retroativo" estiver ativo, não faz nada
      if (!this.selectedFilters.includes('Hoje') && !this.selectedFilters.includes('Retroativo')) {
        // Temporariamente desativar o último botão
        setTimeout(() => {
          this.animateToggleDown(); // Anima a descida dos toggles
  
          // Depois de animar para baixo, reativar todos os toggles
          setTimeout(() => {
            this.selectedFilters.push('AFazer', 'emAndamento', 'finalizada');
            this.animateToggle(); // Anima a reativação
          }, 500); // Tempo para a animação de descida
        }, 300); // Tempo antes de começar a animação
      }
    }
  
    // Anima apenas se o último toggle foi desativado
    if (wasActive && this.selectedFilters.length === 0) {
      this.animateToggle(); // Anima a reativação dos toggles
    }
  }
  
  // Anima a ativação dos toggles
  animateToggle() {
    const toggleElements = document.querySelectorAll('.toggle-switch'); // Seleciona todos os elementos de toggle
    let delay = 0; // Inicializa o atraso
    toggleElements.forEach((element, index) => {
      setTimeout(() => {
        element.classList.add('bounce'); // Adiciona a classe de animação
        setTimeout(() => {
          element.classList.remove('bounce'); // Remove a classe após a animação
        }, 300);
      }, delay);
      delay += 100; // Aumenta o atraso para a próxima animação
    });
  }

  // Anima a descida dos toggles
  animateToggleDown() {
    const toggleElements = document.querySelectorAll('.toggle-switch'); // Seleciona todos os elementos de toggle
    toggleElements.forEach((element, index) => {
      setTimeout(() => {
        element.classList.add('bounceDown'); // Adiciona a classe de animação de descida
        setTimeout(() => {
          element.classList.remove('bounceDown'); // Remove a classe após a animação
        }, 300);
      }, index * 100); // Atraso para cada elemento
    });
  }

  // Alterna a exibição do menu de configuração
  toggleConfigMenu() {
    this.showConfigMenu = !this.showConfigMenu; // Inverte o estado do menu
  }

  // Adiciona zero à esquerda para números menores que 10
  pad(num: number): string {
    return num < 10 ? '0' + num : num.toString(); // Retorna o número formatado
  }

  // Rola a tela até o fundo
  scrollToBottom() {
    const ionContent = document.querySelector('ion-content'); // Seleciona o conteúdo da página
    if (ionContent) {
      ionContent.scrollToBottom(300); // Rola para baixo com uma animação de 300ms
    }
  }
}
