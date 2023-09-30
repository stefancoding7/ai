<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageAI extends Model
{
    protected $table = 'messages';
    use HasFactory;


    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation', 'conversation_id', 'id');
    }

    public function styledContent()
    {
        // Get the content from the model instance
        $content = $this->content;

        $contect = str_replace("<","&lt;",$content);
        $contect = str_replace(">","&gt;",$content);


        // Define the CSS class for code blocks
        $codeBlockClass = 'code-block';

        // Regular expression pattern to match code blocks enclosed in triple backticks
        $pattern = '/```([\s\S]*?)```/';

        // Replace code blocks with styled <pre> tags
        $styledContent = preg_replace_callback($pattern, function ($matches) use ($codeBlockClass) {
            // Wrap the matched code block in <pre> tags with the specified class
            return '<code><pre class="' . $codeBlockClass . '">' . htmlspecialchars($matches[1]) . '</pre></code>';
        }, $content);

        return $styledContent;
    }
}
