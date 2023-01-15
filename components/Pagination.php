<?php
/*
 * Класс для генерации постраничной навигации
 */
class Pagination
{
    /**
        * 
        * @var Ссылок навигации на страницу
        * 
    */
    private $max = 10;

    /**
        * 
        * @var Ключ для GET, в который пишется номер страницы
        * 
    */
    private $index = 'page';

    /**
        * 
        * @var Текущая страница
        * 
    */
    private $current_page;

   /**
        * 
        * @var Общее количество записей
        * 
    */
    private $total;

    /**
        * 
        * @var Записей на страницу
        * 
    */
    private $limit;

    /**
     * Запуск необходимых данных для навигации
     * @param integer $total - общее количество записей
     * @param integer $limit - количество записей на страницу
     * 
     * @return
     */
    public function __construct($total, $limit)
    {
        # Устанавливаем общее количество записей
        $this->total = $total;

        # Устанавливаем количество записей на страницу
        $this->limit = $limit;

        # Устанавливаем количество страниц
        $this->amount = $this->amount();

        # Вызываем метод установки текущей страницы
        $this->setCurrentPage();

        # Вызываем метод установки текущего GET-запроса
    }

    /**
     *  Для вывода ссылок
     * 
     * @return HTML-код со ссылками навигации
     */
    public function get()
    {
        # Для записи ссылок
        $links = null;

        # Получаем ограничения для цикла
        $limits = $this->limits();

        # Генерируем ссылки
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            # Если текущая это текущая страница
            if ($page == $this->current_page)
                # Обводим жирным
                $links .= '<b class="current_page">' . $page . '</b>';
            else
                # Заносим ссылку
                $links .= $this->generateHtml($page);
        }

        # Если ссылки создались
        if (!is_null($links)) {
            # Если текущая страница не первая
            if ($this->current_page > 1)
                # Создаём ссылку "На первую"
                $links = $this->generateHtml(1, '<') . $links;

            # Если текущая страница не первая
            if ($this->current_page < $this->amount)
                # Создаём ссылку "На последнюю"
                $links .= $this->generateHtml($this->amount, '>');
        }

        # Возвращаем ссылки
        return $links;
    }

    /**
     * Для генерации HTML-кода ссылки
     * @param string $query - текущий GET-запрос
     * @param integer $page - номер страницы
     * 
     * @return
     */
    private function generateHtml($page, $text = null)
    {
        # Если текст ссылки не указан
        if (!$text)
            # Указываем, что текст - цифра страницы
            $text = $page;

        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page[0-9]+~', '', $currentURI);
        # Формируем HTML код ссылки и возвращаем
        return
            '<a class="paginations" href="' . $currentURI . $this->index . $page .  '">' . $text . '</a>';
    }

    /**
     *  Для получения, откуда стартовать
     * 
     * @return массив с началом и концом отсчёта
     */
    private function limits()
    {
        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->current_page - round($this->max / 2);

        # Вычисляем начало отсчёта
        $start = $left > 0 ? $left : 1;

        # Если впереди есть как минимум $this->max страниц
        if ($start + $this->max <= $this->amount)
            # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
            $end = $start > 1 ? $start + $this->max : $this->max;
        else {
            # Конец - общее количество страниц
            $end = $this->amount;

            # Начало - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;

        }

        # Возвращаем
        return
            array($start, $end);
    }

    /**
     * Для установки текущей страницы
     * 
     * @return
     */
    private function setCurrentPage()
    {
        # Получаем номер страницы
        $currentURI = explode('/page', $_SERVER['REQUEST_URI']);
        $currentURI = array_pop($currentURI);
        $this->current_page = isset($this->index) ? (int) $currentURI : 1;
        # Если текущая страница боле нуля
        if ($this->current_page > 0) {
            # Если текунщая страница меньше общего количества страниц
            if ($this->current_page > $this->amount)
                # Устанавливаем страницу на последнюю
                $this->current_page = $this->amount;
        } else
            # Устанавливаем страницу на первую
            $this->current_page = 1;
    }

    /**
     * Для получения и установки текущего GET-запроса
     * 
     * @return
     */


    /**
     * Для получеия общего числа страниц
     * 
     * @return число страниц
     */
    private function amount()
    {
        # Делим и возвращаем
        return
            round($this->total / $this->limit);
    }
}