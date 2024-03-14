<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Tables\Columns\CustomButtonColumn;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Support\Enums\ActionSize;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class UsersList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('Email')),
                TextColumn::make('created')
                    ->label(__('Create Date'))
                    ->state(fn (User $record): string => $record->created_at->toDateString()),
                CustomButtonColumn::make('reset')
                    ->action(
                        Action::make('reset')
                            ->requiresConfirmation()
                            ->action(function (User $user) {
                                $user->forceFill([
                                    'password' => Hash::make('123456'),
                                ])->save();
                                Notification::make()
                                    ->title('reset password.')
                                    ->success()
                                    ->send();
                            })
                    )
                    ->label(__('Reset password')),
                ToggleColumn::make('active')
                    ->label(__('Active'))
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make()
                        ->form($this->getInputs())
                        ->modalAlignment(Alignment::Start)
                        ->modalWidth(MaxWidth::ThreeExtraLarge)
                        ->successNotificationTitle(__('User saved successfully.')),
                    // DeleteAction::make()
                    //     ->successNotificationTitle(__('User delete successfully.')),
                ])->size(ActionSize::ExtraSmall)
            ])
            ->headerActions([
                CreateAction::make()
                    ->model(User::class)
                    ->form($this->getInputs())
                    ->modalAlignment(Alignment::Start)
                    ->modalWidth(MaxWidth::ThreeExtraLarge)
                    ->successNotificationTitle(__('User saved successfully.'))
                    ->icon('heroicon-m-plus')
                    ->color('primary')
                    ->label(__('New User'))
            ]);
    }

    public function getInputs(): array
    {
        return [
            Grid::make(2)
                ->schema([
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->required()
                        ->unique(table: User::class, column: 'name', ignoreRecord: true),
                    TextInput::make('email')
                        ->email()
                        ->label(__('Email'))
                        ->required()
                        ->unique(table: User::class, column: 'email', ignoreRecord: true)
                        ->rules(['email']),
                    TextInput::make('password')
                        ->label(__('Password'))
                        ->required()
                        ->password()
                        ->revealable()
                        ->autocomplete(false)
                        ->visible(fn (User $user): bool => empty($user->id)),
                    ToggleButtons::make('active')
                        ->label(__('Active'))
                        ->boolean()
                        ->default(true)
                        ->grouped(),
                ])
        ];
    }

    public function render(): View
    {
        return view('livewire.users.users-list');
    }
}
