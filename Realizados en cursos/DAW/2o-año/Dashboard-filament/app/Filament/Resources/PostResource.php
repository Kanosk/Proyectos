<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('usuario_id')
                    ->relationship('usuario', 'nombre')
                    ->required(),
                Forms\Components\Select::make('categoria_id')
                    ->relationship('categoria', 'nombre')
                    ->required(),
                Forms\Components\TextInput::make('titulo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('cuerpo')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('imagen')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('usuario.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titulo')
                    ->searchable()
                    ->limit(50)
                    ->sortable(),
                Tables\Columns\ImageColumn::make('imagen')
                //hay que usar php artisan storage:link para que se vean las imagenes privadas
                    ->disk('public')
                    ->circular()
                    ->width(40),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('usuario')
                    ->relationship('usuario', 'nombre'),
                    Tables\Filters\SelectFilter::make('categoria')
                    ->relationship('categoria', 'nombre')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
